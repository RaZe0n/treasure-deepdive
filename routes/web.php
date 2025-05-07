<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Models\Game;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landingpage');
});

Route::view('/coach', 'coach.index');


Route::get('/group/{id}', function ($id) {
    return view('coach.group', ['groupId' => $id]);
})->name('coach.group');

Route::view('/name', 'nameinput');

Route::view('/wait', 'game.waitingroom');

Route::view('/leader', 'game.leader');

Route::view('/dropouts', 'game.dropouts');

Route::view('/info', 'game.info');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/test', [GameController::class, 'color']);

Route::view('/test2', 'landingpage');

Route::view('/admin', 'admin.index')->name('admin.index')->middleware(AdminMiddleware::class);
Route::post('/admin', [AdminController::class, 'createGame'])->middleware(AdminMiddleware::class);

Route::get('/game/{game}', [AdminController::class, 'show']);

require __DIR__.'/auth.php';
