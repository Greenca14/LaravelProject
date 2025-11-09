<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;

class JournalController extends Controller
{
    public function index()
    {
        $journals = Journal::all();
        return response()->json($journals);
    }

    public function show($id)
    {
        $journal = Journal::find($id);
        
        if (!$journal) {
            return response()->json(['error' => 'Journal not found'], 404);
        }
        
        return response()->json($journal);
    }
}