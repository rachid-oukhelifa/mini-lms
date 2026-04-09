<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use App\Models\Chapitre;
use App\Models\SousChapitre;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Reponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;

class GenerationIAController extends Controller
{
    public function create()
    {
        return view('generation.create');
    }

        public function store(Request $request)
    {
        $request->validate([
            'prompt' => ['required', 'string', 'min:10'],
        ]);

        $systemPrompt = <<<PROMPT
    Tu es un excellent concepteur de formations pédagogiques professionnelles.

    Réponds **uniquement** avec un JSON valide, sans aucun texte avant ou après, sans markdown, sans ```json.

    Format exact attendu :
    {
    "formation": {
        "nom": "Nom clair et attractif de la formation",
        "description": "Description courte et engageante (2-4 phrases)",
        "niveau": "Débutant / Intermédiaire / Avancé",
        "duree": 5
    },
    "chapitres": [
        {
        "titre": "Titre du chapitre",
        "description": "Description courte du chapitre",
        "sous_chapitres": [
            {
            "titre": "Titre du sous-chapitre",
            "contenu": "Contenu détaillé, bien structuré, en Markdown. Utilise des listes, sous-titres, etc."
            }
        ]
        }
    ],
    "quiz": {
        "titre": "Quiz final - Test de connaissances",
        "questions": [
        {
            "question": "Question claire ?",
            "reponses": [
            {"texte": "Réponse correcte", "est_correcte": true},
            {"texte": "Réponse incorrecte 1", "est_correcte": false},
            {"texte": "Réponse incorrecte 2", "est_correcte": false},
            {"texte": "Réponse incorrecte 3", "est_correcte": false}
            ]
        }
        ]
    }
    }

    La formation doit être claire, progressive et directement utilisable par des apprenants.
    PROMPT;

        $fullPrompt = $systemPrompt . "\n\nDemande de l'utilisateur :\n" . $request->prompt;

        // === APPEL GEMINI AVEC RETRY ET MODÈLE PLUS DISPONIBLE ===
        $modelsToTry = ['gemini-2.5-flash-lite', 'gemini-2.5-flash'];
        $content = null;
        $lastError = null;

        foreach ($modelsToTry as $model) {
            $response = Http::timeout(300)
                ->withHeaders([
                    'x-goog-api-key' => env('GEMINI_API_KEY'),
                    'Content-Type'   => 'application/json',
                ])
                ->post("https://generativelanguage.googleapis.com/v1beta/models/{$model}:generateContent", [
                    'contents' => [
                        ['parts' => [['text' => $fullPrompt]]]
                    ],
                    'generationConfig' => [
                        'temperature' => 0.7,
                        'responseMimeType' => 'application/json',
                        'maxOutputTokens' => 8000,
                    ],
                ]);

            if ($response->successful()) {
                $content = $response->json('candidates.0.content.parts.0.text');
                if ($content) {
                    break;
                }
            } else {
                $errorData = $response->json('error.message') ?? $response->body();
                $lastError = $errorData;

                // Si ce n'est pas une erreur de surcharge, on arrête directement
                if (strpos(strtolower($errorData), 'high demand') === false && 
                    strpos(strtolower($errorData), 'unavailable') === false) {
                    break;
                }

                sleep(3); // petite pause avant d'essayer le modèle suivant
            }
        }

        // Si on n'a toujours pas de contenu
        if (!$content) {
            return back()->withErrors([
                'prompt' => 'Gemini est actuellement très demandé. Merci de réessayer dans 10-30 secondes.'
            ])->withInput();
        }

        // Nettoyage du JSON
        $content = trim($content);
        $content = preg_replace('/^```json\s*/', '', $content);
        $content = preg_replace('/^```\s*/', '', $content);
        $content = preg_replace('/\s*```$/', '', $content);

        $data = json_decode($content, true);

        if (!is_array($data) || !isset($data['formation'], $data['chapitres'], $data['quiz'])) {
            return back()->withErrors([
                'prompt' => 'Le JSON retourné est invalide. Veuillez réessayer.'
            ])->withInput();
        }

        // === ENREGISTREMENT EN BASE ===
        DB::beginTransaction();

        try {
            $formation = Formation::create([
                'nom'        => $data['formation']['nom'] ?? 'Formation générée par IA',
                'description'=> $data['formation']['description'] ?? null,
                'niveau'     => $data['formation']['niveau'] ?? null,
                'duree'      => $data['formation']['duree'] ?? 5,
            ]);

            $lastSousChapitre = null;

            foreach ($data['chapitres'] as $chapitreData) {
                $chapitre = Chapitre::create([
                    'titre'        => $chapitreData['titre'] ?? 'Chapitre',
                    'description'  => $chapitreData['description'] ?? null,
                    'formation_id' => $formation->id,
                ]);

                foreach (($chapitreData['sous_chapitres'] ?? []) as $sousData) {
                    $lastSousChapitre = SousChapitre::create([
                        'titre'       => $sousData['titre'] ?? 'Sous-chapitre',
                        'contenu'     => $sousData['contenu'] ?? '',
                        'chapitre_id' => $chapitre->id,
                    ]);
                }
            }

            if (!$lastSousChapitre) {
                throw new \Exception('Aucun sous-chapitre généré.');
            }

            $quiz = Quiz::create([
                'titre'            => $data['quiz']['titre'] ?? 'Quiz de validation',
                'sous_chapitre_id' => $lastSousChapitre->id,
            ]);

            foreach (($data['quiz']['questions'] ?? []) as $qData) {
                $question = Question::create([
                    'question' => $qData['question'] ?? 'Question',
                    'quiz_id'  => $quiz->id,
                ]);

                foreach (($qData['reponses'] ?? []) as $rData) {
                    Reponse::create([
                        'texte'        => $rData['texte'] ?? '',
                        'est_correcte' => (bool) ($rData['est_correcte'] ?? false),
                        'question_id'  => $question->id,
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('formations.index')
                ->with('success', '✅ Formation générée avec succès par Gemini !');

        } catch (\Throwable $e) {
            DB::rollBack();
            return back()->withErrors([
                'prompt' => 'Erreur lors de la sauvegarde : ' . $e->getMessage()
            ])->withInput();
        }
    }
}