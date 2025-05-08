<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\IsGuestMiddelware;
use App\Models\Game;
use Illuminate\Support\Facades\Route;

Route::view('/', 'landingpage');
Route::post('/', [GameController::class, 'validatePin']);

Route::get('/name', [GameController::class, 'showNameInput'])->name('nameInput');
Route::post('/name', [GameController::class, 'validateName']);

Route::get('/coach', [CoachController::class, 'show']);
Route::post('/coach', [GameController::class, 'createGroups']);

Route::middleware(IsGuestMiddelware::class)->group(function () {
    Route::get('/wait', [GameController::class, 'showWaitingRoom'])->name('waitingRoom');

    Route::get('/group', [GameController::class, 'color']);

    Route::view('/leader', 'game.leader');

    Route::view('/dropouts', 'game.dropouts');

    Route::view('/info', 'game.info');

    Route::view('/practice', 'game.practice');
});

Route::get('/group/{id}', function ($id) {
    return view('coach.group', ['groupId' => $id]);
})->name('coach.group');

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
Route::post('/game/{game}', [AdminController::class, 'startGame']);

require __DIR__ . '/auth.php';
