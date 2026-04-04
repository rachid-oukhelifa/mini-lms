<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Formation;
use App\Models\Chapitre;
use App\Models\SousChapitre;
use App\Models\Quiz;
use App\Models\Question;
use App\Models\Reponse;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Créer admin
        User::firstOrCreate(
            ['email' => 'admin@lms.fr'],
            [
                'name' => 'Admin',
                'password' => Hash::make('Admin@LMS2026!'),
                'role' => 'admin',
            ]
        );

        // Créer apprenant
        User::firstOrCreate(
            ['email' => 'apprenant@lms.fr'],
            [
                'name' => 'Apprenant Test',
                'password' => Hash::make('Apprenant@LMS2026!'),
                'role' => 'apprenant',
            ]
        );

        // Formation
        $formation = Formation::firstOrCreate(
            ['nom' => 'Anglais débutant'],
            [
                'description' => 'Formation sur les bases de l\'anglais',
                'niveau' => 'Débutant',
                'duree' => 10,
            ]
        );

        // Chapitre
        $chapitre = Chapitre::firstOrCreate(
            ['titre' => 'Les verbes irréguliers'],
            [
                'description' => 'Introduction aux verbes irréguliers en anglais',
                'formation_id' => $formation->id,
            ]
        );

        // Sous-chapitre
        $sousChapitre = SousChapitre::firstOrCreate(
            ['titre' => '10 verbes indispensables à connaître'],
            [
                'contenu' => "Go → went → gone\nBe → was/were → been\nHave → had → had\nDo → did → done\nSay → said → said\nGet → got → got\nMake → made → made\nKnow → knew → known\nTake → took → taken\nCome → came → come",
                'chapitre_id' => $chapitre->id,
            ]
        );

        // Quiz
        $quiz = Quiz::firstOrCreate(
            ['titre' => 'Quiz verbes irréguliers'],
            ['sous_chapitre_id' => $sousChapitre->id]
        );

        // Questions
        $questions = [
            [
                'question' => 'Quel est le prétérit de "go" ?',
                'reponses' => ['goed', 'went', 'gone', 'goes'],
                'correcte' => 1,
            ],
            [
                'question' => 'Quel est le prétérit de "have" ?',
                'reponses' => ['haved', 'has', 'had', 'have'],
                'correcte' => 2,
            ],
            [
                'question' => 'Quel est le participe passé de "know" ?',
                'reponses' => ['knowed', 'knew', 'known', 'knows'],
                'correcte' => 2,
            ],
            [
                'question' => 'Quel est le prétérit de "make" ?',
                'reponses' => ['maked', 'made', 'makes', 'making'],
                'correcte' => 1,
            ],
            [
                'question' => 'Quel est le participe passé de "take" ?',
                'reponses' => ['taked', 'took', 'taken', 'takes'],
                'correcte' => 2,
            ],
        ];

        foreach ($questions as $q) {
            $question = Question::firstOrCreate(
                ['question' => $q['question'], 'quiz_id' => $quiz->id]
            );

            if ($question->reponses()->count() == 0) {
                foreach ($q['reponses'] as $index => $texte) {
                    Reponse::create([
                        'texte' => $texte,
                        'est_correcte' => $index == $q['correcte'],
                        'question_id' => $question->id,
                    ]);
                }
            }
        }
    }
}