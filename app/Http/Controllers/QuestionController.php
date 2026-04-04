<?php

namespace App\Http\Controllers;

use App\Models\Question;
use App\Models\Reponse;
use App\Models\Quiz;
use Illuminate\Http\Request;

class QuestionController extends Controller
{
    public function create(Request $request)
    {
        $quiz = Quiz::findOrFail($request->quiz_id);
        return view('questions.create', compact('quiz'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string',
            'quiz_id' => 'required|exists:quizzes,id',
            'reponses' => 'required|array|min:2',
            'reponses.*' => 'required|string',
            'bonne_reponse' => 'required|integer',
        ]);

        $question = Question::create([
            'question' => $request->question,
            'quiz_id' => $request->quiz_id,
        ]);

        foreach ($request->reponses as $index => $texte) {
            Reponse::create([
                'texte' => $texte,
                'est_correcte' => $index == $request->bonne_reponse,
                'question_id' => $question->id,
            ]);
        }

        return redirect()->route('quizzes.show', $request->quiz_id)->with('success', 'Question ajoutée !');
    }

    public function destroy(string $id)
    {
        $question = Question::findOrFail($id);
        $quiz_id = $question->quiz_id;
        $question->delete();
        return redirect()->route('quizzes.show', $quiz_id)->with('success', 'Question supprimée !');
    }
}