<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonController extends Controller
{
    public function index()
    {
        $persons = Person::all();
        return response()->json($persons);
    }

    public function show($id)
    {
        $person = Person::find($id);
        
        if (!$person) {
            return response()->json(['error' => 'Person not found'], 404);
        }
        
        return response()->json($person);
    }
}