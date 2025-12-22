<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Person;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Exception;

class PersonControllerApi extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->perpage ?? 5;
        $page = $request->page ?? 0;
        
        $persons = Person::withCount('publications')
            ->limit($perPage)
            ->offset($perPage * $page)
            ->get();
            
        return response()->json($persons);
    }

    public function show($id)
    {
        $person = Person::find($id);
        if (!$person) {
            return response()->json(['error' => 'Персона не найдена'], 404);
        }
        return response()->json($person);
    }

    public function store(Request $request)
    {

        $validated = $request->validate([
            'full_name' => 'required|string|max:255',
            'birth_date' => 'nullable|date',
            'avatar' => 'nullable|file|mimes:jpg,jpeg,png,gif|max:2048'
        ]);

        $avatarUrl = null;

        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $fileName = uniqid() . '_' . $file->getClientOriginalName();

            try {
                $path = Storage::disk('s3')->putFileAs(
                    'persons/avatars',
                    $file,
                    $fileName
                );
                $avatarUrl = Storage::disk('s3')->url($path);

            } catch (Exception $e) {
                return response()->json([
                    'code' => 2,
                    'message' => 'Ошибка загрузки файла в S3',
                    'error' => $e->getMessage()
                ], 500);
            }
        }

        $person = new Person($validated);
        $person->avatar = $avatarUrl;
        $person->save();

        return response()->json([
            'code' => 0,
            'message' => 'Персона успешно добавлена',
            'person' => $person
        ], 201);
    }

    public function total()
    {
        $count = Person::count();
        return response()->json($count);
    }
}