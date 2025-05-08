<?php

namespace App\Http\Controllers;

use App\Models\Game;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CoachController extends Controller
{
    public function show()
    {
        $pin = Auth::user()->pin;

        $game = Game::where('pin', $pin)->first();

        if (!$game) {
            abort(418);
        }

        return view('coach.index', ['game' => $game]);
    }
}
