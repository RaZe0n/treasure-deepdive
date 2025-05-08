<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Guest;
use App\Models\Team;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GameController extends Controller
{
    public function validatePin(Request $request)
    {
        if (!$request->pin) {
            return back();
        }
        $game = Game::where('pin', $request->pin)->where('pin', '!=', NULL)->first();
        if (!$game) {
            return back()->withErrors(['error' => 'Er is geen game met deze pin!']);
        }
        session(['game_id' => $game->id]);
        return to_route('nameInput');
    }

    public function showNameInput()
    {
        $game_id = session('game_id');
        if (!$game_id) {
            return redirect('/')->withErrors(['error' => 'vull eerst een pin in!']);
        }
        return view('nameinput');
    }

    public function validateName(Request $request)
    {
        $game = Game::find(session('game_id'));

        $isValid = $game->enlisted_guests()->where('name', ucwords()($request->name))->exists();

        if (!$isValid) {
            return back()->withErrors(['error' => '"' . $request->name . '" bestaat niet']);
        }

        $guest = Guest::create([
            'name' => strtoupper($request->name),
            'pin' => session('game_id'),
        ]);

        session(['guest_id' => $guest->id]);

        return to_route('waitingRoom');
    }

    public function showWaitingRoom()
    {
        return view('game.waitingroom');
    }

    public function color() {
        $naam = "Groen";
        $kleur = "green-500";

        return view("game.vraag", ["naam" => $naam, "kleur" => $kleur]);
    }

    public function createGroups(Request $request)
    {
        $pin = Auth::user()->pin;

        $game = Game::where('pin', $pin)->first();

        $guests = Guest::where('pin', $game->pin)->inRandomOrder()->get();

        $totalGuests = $guests->count();
        $totalTeams = $request->groupsAmount;

        $defaultTeamSize = intdiv($totalGuests, $totalTeams);
        $leftOverGuests = $totalGuests % $totalTeams;

        for ($i = 0; $i < $request->groupsAmount; $i++) {
        $GuestCount = $i < $leftOverGuests ? $defaultTeamSize + 1 : $defaultTeamSize;
            $team = Team::create([
                'game_id' => $game->id,
                'color' => 'red',
            ]);

            $teamMembers = collect();
            for ($ii = 0; $ii < $GuestCount; $ii++) {
                $guests->first()->team_id = $team->id;
                $guests->first()->save();
                $teamMembers->push($guests->shift());
            }
            $teamMembers = $guests->slice($GuestCount);
        }

    }
}
