<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class ApprenantQuizController extends Controller
{
    public function show(string $id)
    {
        $quiz = Quiz::with('questions.reponses')->findOrFail($id);
        return view('apprenant.quiz', compact('quiz'));
    }

    public function submit(Request $request, string $id)
    {
        $quiz = Quiz::with('questions.reponses')->findOrFail($id);

        $score = 0;
        $total = $quiz->questions->count();
        $resultats = [];

        foreach ($quiz->questions as $question) {
            $reponseChoisieId = $request->input('reponse_' . $question->id);
            $bonneReponse = $question->reponses->where('est_correcte', true)->first();
            $reponseChoisie = $question->reponses->find($reponseChoisieId);

            $correct = $reponseChoisie && $reponseChoisie->est_correcte;
            if ($correct) $score++;

            $resultats[] = [
                'question' => $question->question,
                'choisie' => $reponseChoisie?->texte ?? 'Aucune réponse',
                'correcte' => $bonneReponse?->texte,
                'ok' => $correct,
            ];
        }

        return view('apprenant.resultat', compact('quiz', 'score', 'total', 'resultats'));
    }
}