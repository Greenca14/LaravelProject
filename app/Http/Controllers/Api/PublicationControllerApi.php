<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;

class PublicationControllerApi extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perpage ?? 5;
        $page = $request->page ?? 0;
        
        $publications = Publication::with(['journal', 'persons'])
            ->orderBy('created_at', 'desc')
            ->limit($perPage)
            ->offset($perPage * $page)
            ->get();
            
        return response()->json($publications);
    }

    public function total()
    {
        $count = Publication::count();
        return response()->json($count);
    }

    public function show($id)
    {
        $publication = Publication::with(['journal', 'persons'])->find($id);
        
        if (!$publication) {
            return response()->json(['error' => 'Publication not found'], 404);
        }
        
        return response()->json($publication);
    }
}