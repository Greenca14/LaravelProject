<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Publication;
use Illuminate\Http\Request;
 
class PublicationController extends Controller
{
    public function index()
    {
        $publications = Publication::all();
        return response()->json($publications);
    }

    public function show($id)
    {
        $publication = Publication::find($id);
        
        if (!$publication) {
            return response()->json(['error' => 'Publication not found'], 404);
        }
        
        return response()->json($publication);
    }
}