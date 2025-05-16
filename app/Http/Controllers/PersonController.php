<?php

namespace App\Http\Controllers;

use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{

    public function index()
    {
        $persons = Person::paginate(10);
        return view('persons.index', compact('persons'));
    }

    public function create()
    {
        return view('persons.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        Person::create($validated);

        return redirect()->route('persons.index')->with('success', 'Персона добавлена');
    }

    public function show(Person $person)
    {
        return view('persons.show', compact('person'));
    }

    public function edit(Person $person)
    {
        return view('persons.edit', compact('person'));
    }

    public function update(Request $request, Person $person)
    {
        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'required|date',
        ]);

        $person->update($validated);

        return redirect()->route('persons.index')->with('success', 'Персона обновлена');
    }

    public function destroy(Person $person)
    {
        $person->delete();
        return redirect()->route('persons.index')->with('success', 'Персона удалена');
    }
}