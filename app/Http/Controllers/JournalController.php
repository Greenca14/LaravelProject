<?php

namespace App\Http\Controllers;

use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{


    public function index()
    {
        $journals = Journal::withCount('publications')->paginate(10);
        return view('journals.index', compact('journals'));
    }

    public function create()
    {
        return view('journals.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:journals',
        ]);

        Journal::create($validated);

        return redirect()->route('journals.index')->with('success', 'Журнал добавлен');
    }

    public function show(Journal $journal)
    {
        $journal->load('publications.authors.person');
        return view('journals.show', compact('journal'));
    }

    public function edit(Journal $journal)
    {
        return view('journals.edit', compact('journal'));
    }

    public function update(Request $request, Journal $journal)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255|unique:journals,name,'.$journal->id,
        ]);

        $journal->update($validated);

        return redirect()->route('journals.index')->with('success', 'Журнал обновлен');
    }

    public function destroy(Journal $journal)
    {
        $journal->delete();
        return redirect()->route('journals.index')->with('success', 'Журнал удален');
    }
}