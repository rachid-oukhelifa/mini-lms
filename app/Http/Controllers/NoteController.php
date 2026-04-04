<?php

namespace App\Http\Controllers;

use App\Models\Note;
use App\Models\User;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    public function index()
    {
        $notes = Note::with('user')->get();
        return view('notes.index', compact('notes'));
    }

    public function create()
    {
        $apprenants = User::where('role', 'apprenant')->get();
        return view('notes.create', compact('apprenants'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'matiere' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        Note::create($request->all());
        return redirect()->route('notes.index')->with('success', 'Note ajoutée avec succès !');
    }

    public function edit(string $id)
    {
        $note = Note::findOrFail($id);
        $apprenants = User::where('role', 'apprenant')->get();
        return view('notes.edit', compact('note', 'apprenants'));
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'note' => 'required|numeric|min:0|max:20',
            'matiere' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ]);

        $note = Note::findOrFail($id);
        $note->update($request->all());
        return redirect()->route('notes.index')->with('success', 'Note modifiée avec succès !');
    }

    public function destroy(string $id)
    {
        $note = Note::findOrFail($id);
        $note->delete();
        return redirect()->route('notes.index')->with('success', 'Note supprimée !');
    }

    public function mesNotes()
    {
        $notes = Note::where('user_id', auth()->id())->get();
        return view('notes.mes_notes', compact('notes'));
    }
}