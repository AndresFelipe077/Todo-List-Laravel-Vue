<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\NoteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiResource('tasks', NoteController::class)->middleware('auth:api');
Route::post('tasks/{id}', [NoteController::class, 'update'])->middleware('auth:api');

Route::get(uri: 'storage-link', action: function (): void {
    Artisan::call(command: 'storage:link');
    echo (Artisan::output());
});