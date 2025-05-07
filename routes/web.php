<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

Route::view('/coach', 'coach.index');


Route::get('/group/{id}', function ($id) {
    return view('coach.group', ['groupId' => $id]);
})->name('coach.group');

Route::view('/name', 'nameinput');

Route::view('/wait', 'game/waitingroom');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::view('/test', 'game.map');

require __DIR__.'/auth.php';
