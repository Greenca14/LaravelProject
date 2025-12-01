<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;

class PersonControllerApi extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perpage ?? 10;
        $page = $request->page ?? 0;
        
        $persons = Person::withCount('publications')
            ->limit($perPage)
            ->offset($perPage * $page)
            ->get();
            
        return response()->json($persons);
    }

    public function total()
    {
        $count = Person::count();
        return response()->json($count);
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