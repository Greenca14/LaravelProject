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
    
    $publications = Publication::with(['journal', 'authors.person'])
        ->orderBy('created_at', 'desc')
        ->limit($perPage)
        ->offset($perPage * $page)
        ->get();
        
    $publications->transform(function ($publication) {
        $publication->authors = $publication->authors->map(function ($author) {
            return [
                'id' => $author->person->id,
                'full_name' => $author->person->full_name,
                'contribution_share' => $author->contribution_share
            ];
        });
        return $publication;
    });
    
    return response()->json($publications);
}

    public function total()
    {
        $count = Publication::count();
        return response()->json($count);
    }

    public function show($id)
    {
        $publication = Publication::with(['journal', 'authors'])->find($id);
        
        if (!$publication) {
            return response()->json(['error' => 'Publication not found'], 404);
        }
        
        return response()->json($publication);
    }
}