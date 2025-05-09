<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CoachController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\ProfileController;
use App\Http\Middleware\AdminMiddleware;
use App\Http\Middleware\IsGuestMiddelware;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Broadcast;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

// Remove the Broadcast::routes() call
// Broadcast::routes(['middleware' => ['web']]);

// Add direct broadcasting auth route
Route::post('/broadcasting/auth', function (Request $request) {
    try {
        Log::info('Broadcasting auth request received', [
            'session_guest_id' => Session::get('guest_id'),
            'channel' => $request->input('channel_name'),
            'socket_id' => $request->input('socket_id'),
            'session_id' => Session::getId(),
            'session_data' => Session::all(),
            'request_data' => $request->all()
        ]);

        // Extract guest ID from channel name (private-user.123)
        $channelName = $request->input('channel_name');
        $channelParts = explode('.', $channelName);
        $requestedGuestId = end($channelParts);
        $sessionGuestId = Session::get('guest_id');

        // If no session guest ID, set it from the channel
        if (!$sessionGuestId) {
            $sessionGuestId = $requestedGuestId;
            Session::put('guest_id', $sessionGuestId);
            Session::save();
            Log::info('Setting guest ID from channel', [
                'guest_id' => $sessionGuestId,
                'session_id' => Session::getId()
            ]);
        }

        // Compare IDs
        $isAuthorized = (string) $sessionGuestId === (string) $requestedGuestId;
        
        Log::info('Broadcasting auth result', [
            'session_guest_id' => $sessionGuestId,
            'requested_guest_id' => $requestedGuestId,
            'is_authorized' => $isAuthorized,
            'session_id' => Session::getId()
        ]);

        if (!$isAuthorized) {
            return response()->json([
                'error' => 'Unauthorized',
                'details' => [
                    'session_guest_id' => $sessionGuestId,
                    'requested_guest_id' => $requestedGuestId
                ]
            ], 403);
        }

        // Generate auth signature using Pusher format
        $pusherKey = config('broadcasting.connections.pusher.key');
        $pusherSecret = config('broadcasting.connections.pusher.secret');
        $socketId = $request->input('socket_id');
        $channelName = $request->input('channel_name');
        
        // Create signature string
        $stringToSign = $socketId . ':' . $channelName;
        $signature = hash_hmac('sha256', $stringToSign, $pusherSecret);
        
        // Return Pusher auth response format
        return response()->json([
            'auth' => $pusherKey . ':' . $signature
        ]);

    } catch (\Exception $e) {
        Log::error('Broadcasting auth error', [
            'error' => $e->getMessage(),
            'trace' => $e->getTraceAsString(),
            'session_id' => Session::getId(),
            'session_data' => Session::all(),
            'request_data' => $request->all()
        ]);
        return response()->json([
            'error' => $e->getMessage()
        ], 403);
    }
})->middleware(['web']);

Route::view('/', 'landingpage');
Route::post('/', [GameController::class, 'validatePin']);

Route::get('/name', [GameController::class, 'showNameInput'])->name('nameInput');
Route::post('/name', [GameController::class, 'validateName']);

Route::middleware('auth')->group(function () {
    Route::get('/coach', [CoachController::class, 'show']);
    Route::post('/coach', [GameController::class, 'createGroups'])->name('coach.createGroups');
    Route::get('/redirect-guests', [GameController::class, 'redirectGuests']);
    Route::post('/redirect-guests-without-groups', [GameController::class, 'redirectGuestsWithoutGroups'])->name('coach.redirectGuestsWithoutGroups');
});

Route::middleware(IsGuestMiddelware::class)->group(function () {
    Route::get('/wait', [GameController::class, 'showWaitingRoom'])->name('waitingRoom');
    Route::get('/check-redirect', [GameController::class, 'checkRedirect']);
    Route::get('/check-group-assignment', [GameController::class, 'checkGroupAssignment']);

    Route::get('/group', [GameController::class, 'color']);
    Route::get('/game/groupcolor/{color}/{name}', [GameController::class, 'color'])->name('game.groupcolor');

    Route::view('/leader', 'game.leader');

    Route::view('/dropouts', 'game.dropouts');

    Route::view('/info', 'game.info')->name('info');

    Route::view('/practice', 'game.practice')->name('practice');

    Route::view('/hint', 'game.hint')->name('hint');
});


Route::get('/group/{team}', [CoachController::class, 'showGroup'])->name('coach.group');
Route::put('/group/changeTeamGids', [CoachController::class, 'changeTeamGids']);

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/vraag', [GameController::class, 'vraag'])->name('vraag');
Route::get('/test2', [GameController::class, 'color']);
Route::view('/map', 'game.map')->name('map');

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

// Test route for group assignment
Route::get('/test-group-assignment', function () {
    event(new \App\Events\GroupAssigned(
        auth()->user->id,
        'blue',
        'Test Group',
        route('game.groupcolor', ['color' => 'blue', 'name' => 'Test Group'])
    ));
    return 'Event dispatched!';
})->middleware('auth');

require __DIR__ . '/auth.php';
