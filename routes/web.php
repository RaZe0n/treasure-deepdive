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

    Route::view('/hint', 'game.hint');
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

Route::view('/test', 'game.vraag');
Route::get('/test2', [GameController::class, 'color']);
Route::view('/map', 'game.map');

Route::middleware(AdminMiddleware::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::post('/admin', [AdminController::class, 'createGame'])->name('admin.game.create');
    Route::delete('/admin/game/{game}', [AdminController::class, 'destroy'])->name('admin.game.destroy');
    Route::get('/admin/game/{game}', [AdminController::class, 'show'])->name('admin.game.show');

    // Team Management
    Route::post('/admin/game/{game}/team', [AdminController::class, 'storeTeam'])->name('admin.game.team.store');
    Route::delete('/admin/game/{game}/team/{team}', [AdminController::class, 'destroyTeam'])->name('admin.game.team.destroy');

    // Guest Management
    Route::post('/admin/game/{game}/guest', [AdminController::class, 'storeGuest'])->name('admin.game.guest.store');
    Route::delete('/admin/game/{game}/team/{team}/guest/{guest}', [AdminController::class, 'destroyGuest'])->name('admin.game.guest.destroy');
    Route::delete('/admin/game/{game}/enlisted-guest/{guest}', [AdminController::class, 'destroyEnlistedGuest'])->name('admin.game.enlisted-guest.destroy');

    // Coach Management
    Route::post('/admin/game/{game}/coach', [AdminController::class, 'storeCoach'])->name('admin.game.coach.store');
    Route::delete('/admin/game/{game}/coach', [AdminController::class, 'removeCoach'])->name('admin.game.coach.remove');
});


require __DIR__ . '/auth.php';
