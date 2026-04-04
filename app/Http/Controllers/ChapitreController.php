<?php

namespace App\Http\Controllers;

use App\Models\Chapitre;
use App\Models\Formation;
use Illuminate\Http\Request;

class ChapitreController extends Controller
{
    public function index()
    {
        $chapitres = Chapitre::with('formation')->get();
        return view('chapitres.index', compact('chapitres'));
    }

    public function create()
    {
        $formations = Formation::all();
        return view('chapitres.create', compact('formations'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'formation_id' => 'required|exists:formations,id',
        ]);

        Chapitre::create($request->all());
        return redirect()->route('chapitres.index')->with('success', 'Chapitre créé avec succès !');
    }

    public function show(string $id)
    {
        $chapitre = Chapitre::with('sousChapitres')->findOrFail($id);
        return view('chapitres.show', compact('chapitre'));
    }

    public function edit(string $id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $formations = Formation::all();
        return view('chapitres.edit', compact('chapitre', 'formations'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'description' => 'nullable|string',
            'formation_id' => 'required|exists:formations,id',
        ]);

        $chapitre = Chapitre::findOrFail($id);
        $chapitre->update($request->all());
        return redirect()->route('chapitres.index')->with('success', 'Chapitre modifié avec succès !');
    }

    public function destroy(string $id)
    {
        $chapitre = Chapitre::findOrFail($id);
        $chapitre->delete();
        return redirect()->route('chapitres.index')->with('success', 'Chapitre supprimé !');
    }
}