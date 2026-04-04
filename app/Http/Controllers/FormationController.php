<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationController extends Controller
{
    public function index()
    {
        $formations = Formation::all();
        return view('formations.index', compact('formations'));
    }

    public function create()
    {
        return view('formations.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau' => 'nullable|string',
            'description' => 'nullable|string',
            'duree' => 'nullable|integer',
        ]);

        Formation::create($request->all());
        return redirect()->route('formations.index')->with('success', 'Formation créée avec succès !');
    }

    public function show(string $id)
    {
        $formation = Formation::with('chapitres')->findOrFail($id);
        return view('formations.show', compact('formation'));
    }

    public function edit(string $id)
    {
        $formation = Formation::findOrFail($id);
        return view('formations.edit', compact('formation'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'niveau' => 'nullable|string',
            'description' => 'nullable|string',
            'duree' => 'nullable|integer',
        ]);

        $formation = Formation::findOrFail($id);
        $formation->update($request->all());
        return redirect()->route('formations.index')->with('success', 'Formation modifiée avec succès !');
    }

    public function destroy(string $id)
    {
        $formation = Formation::findOrFail($id);
        $formation->delete();
        return redirect()->route('formations.index')->with('success', 'Formation supprimée !');
    }
}