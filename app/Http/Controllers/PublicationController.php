<?php

namespace App\Http\Controllers;

use App\Models\Publication;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Journal;

class PublicationController extends Controller
{ 
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $publications = Publication::with('journal')->get();
        return view('publications.index', compact('publications'));
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $publication = Publication::with('authors')->findOrFail($id);
        return view('publications.show', compact('publication'));
    }

    public function create()
    {
        $journals = Journal::all();
        return view('publications.create', compact('journals'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'journal_id' => 'required|exists:journals,id',
            'title' => 'required|string|max:255',
            'publication_date' => 'required|date',
        ]);

        Publication::create($validated);
        return redirect()->route('publications.index')->with('success', 'Публикация добавлена!');
    }

    public function edit(Publication $publication)
    {
        $journals = Journal::all();
        return view('publications.edit', compact('publication', 'journals'));
    }

    public function update(Request $request, Publication $publication)
    {
        $validated = $request->validate([
            'journal_id' => 'required|exists:journals,id',
            'title' => 'required|string|max:255',
            'publication_date' => 'required|date',
        ]);

        $publication->update($validated);
        return redirect()->route('publications.index')->with('success', 'Публикация обновлена!');
    }

    public function destroy(Publication $publication)
    {
        $publication->delete();
        return redirect()->route('publications.index')->with('success', 'Публикация удалена!');
    }
}
