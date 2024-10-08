<?php

declare(strict_types=1);

namespace App\Http\Controllers;

use App\Models\Note;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class NoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        $user_id = auth()->user()->id;
        $tasks = Note::where('user_id', operator: $user_id)->orderBy('id', 'desc')->get();
        return response()->json($tasks);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $user_id = auth()->user()->id;
        $request->request->add(['user_id' => $user_id]);

        if ($request->hasFile('file')) {
            $imagePath = $request->file('file')->store('images', 'public'); // Guarda la imagen en el directorio 'storage/app/public/images'
            $request->request->add(['image' => $imagePath]); // Agrega la ruta de la imagen al request
        }

        $task = Note::create($request->all());

        return response()->json($task, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $task = Note::findOrFail($id);
        $task->tags = json_decode($task->tags, true);
        return response()->json($task, 200);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id): JsonResponse
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
        ]);

        $task = Note::findOrFail($id);

        if ($request->hasFile('file')) {
            $imagePath = $request->file('file')->store('images', 'public'); // Guarda la imagen en el directorio 'storage/app/public/images'
            $request->request->add(['image' => $imagePath]); // Agrega la ruta de la imagen al request
        }

        $task->update($request->all());
        return response()->json($task, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        Note::findOrFail($id)->delete();
        return response()->json(null, 204);
    }
}
