<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Guest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Team;
use Illuminate\Support\Facades\Redis;

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

    public function showGroup(Team $team)
    {
        $teamMembers = Guest::where('team_id', $team->id)->get();
        return view('coach.group', ['team' => $team, 'teamMembers' => $teamMembers]);
    }

    public function changeTeamGids(Request $request)
    {
        $team = Team::find($request->team_id);
        $team->guest_id = $request->guest_id;
        $team->save();
    }
}
