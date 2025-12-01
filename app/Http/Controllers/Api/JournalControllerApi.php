<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Journal;
use Illuminate\Http\Request;

class JournalControllerApi extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perpage ?? 5;
        $page = $request->page ?? 0;
        
        $journals = Journal::withCount('publications')
            ->limit($perPage)
            ->offset($perPage * $page)
            ->get();
            
        return response()->json($journals);
    }

    public function total()
    {
        $count = Journal::count();
        return response()->json($count);
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