<?php

namespace App\Http\Controllers;

use App\Models\SousChapitre;
use App\Models\Chapitre;
use Illuminate\Http\Request;

class SousChapitreController extends Controller
{
    public function index()
    {
        $sousChapitres = SousChapitre::with('chapitre')->get();
        return view('sous_chapitres.index', compact('sousChapitres'));
    }

    public function create()
    {
        $chapitres = Chapitre::with('formation')->get();
        return view('sous_chapitres.create', compact('chapitres'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'nullable|string',
            'chapitre_id' => 'required|exists:chapitres,id',
        ]);

        SousChapitre::create($request->all());
        return redirect()->route('sous_chapitres.index')->with('success', 'Sous-chapitre créé avec succès !');
    }

    public function show(string $id)
    {
        $sousChapitre = SousChapitre::with('contenus', 'quiz')->findOrFail($id);
        return view('sous_chapitres.show', compact('sousChapitre'));
    }

    public function edit(string $id)
    {
        $sousChapitre = SousChapitre::findOrFail($id);
        $chapitres = Chapitre::with('formation')->get();
        return view('sous_chapitres.edit', compact('sousChapitre', 'chapitres'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'titre' => 'required|string|max:255',
            'contenu' => 'nullable|string',
            'chapitre_id' => 'required|exists:chapitres,id',
        ]);

        $sousChapitre = SousChapitre::findOrFail($id);
        $sousChapitre->update($request->all());
        return redirect()->route('sous_chapitres.index')->with('success', 'Sous-chapitre modifié avec succès !');
    }

    public function destroy(string $id)
    {
        $sousChapitre = SousChapitre::findOrFail($id);
        $sousChapitre->delete();
        return redirect()->route('sous_chapitres.index')->with('success', 'Sous-chapitre supprimé !');
    }
}