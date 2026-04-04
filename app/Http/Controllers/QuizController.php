<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use App\Models\SousChapitre;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::with('sousChapitre')->get();
        return view('quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $sousChapitres = SousChapitre::with('chapitre')->get();
        return view('quizzes.create', compact('sousChapitres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'sous_chapitre_id' => 'required|exists:sous_chapitres,id',
        ]);

        Quiz::create($request->all());
        return redirect()->route('quizzes.index')->with('success', 'Quiz créé avec succès !');
    }

    public function show(string $id)
    {
        $quiz = Quiz::with('questions.reponses')->findOrFail($id);
        return view('quizzes.show', compact('quiz'));
    }

    public function edit(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $sousChapitres = SousChapitre::with('chapitre')->get();
        return view('quizzes.edit', compact('quiz', 'sousChapitres'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'sous_chapitre_id' => 'required|exists:sous_chapitres,id',
        ]);

        $quiz = Quiz::findOrFail($id);
        $quiz->update($request->all());
        return redirect()->route('quizzes.index')->with('success', 'Quiz modifié avec succès !');
    }

    public function destroy(string $id)
    {
        $quiz = Quiz::findOrFail($id);
        $quiz->delete();
        return redirect()->route('quizzes.index')->with('success', 'Quiz supprimé !');
    }
}