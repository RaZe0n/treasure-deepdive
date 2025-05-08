<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\File;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/json/{filename}', function ($filename) {
    $path = resource_path("json/{$filename}");

    if (!File::exists($path)) {
        abort(404);
    }

    $content = File::get($path);
    $json = json_decode($content, true);

    return response()->json($json);
});

Route::post('/groups/generate', [App\Http\Controllers\GroupController::class, 'generateGroups'])->middleware('auth');
