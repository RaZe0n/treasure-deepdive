<?php

namespace App\Http\Controllers;

use App\Models\EnlistedGuests;
use App\Models\Game;
use App\Models\Team;
use App\Models\Guest;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $games = Game::with('enlisted_guests')->get();
        $activeGamesCount = $games->count();
        $activeTeamsCount = $games->sum(function($game) {
            return $game->enlisted_guests->count();
        });

        return view('admin.index', [
            'activeGames' => $games,
            'activeGamesCount' => $activeGamesCount,
            'activeTeamsCount' => $activeTeamsCount
        ]);
    }

    public function createGame(Request $request)
    {
        $game = Game::create([
            'name' => $request->name
        ]);

        EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Rutger van der Kooi', 'class_name' => '23SDB']);
        // EnlistedGuests::create(['game_id' => $game->id, 'name' => 'Finn Bruinzeel', 'class_name' => '23SDB']);

        return redirect()->route('admin.index')->with('success', 'Game created successfully');
    }

    public function show(Game $game)
    {
        $game->load(['teams.guests', 'enlisted_guests']);
        $users = User::all();
        return view('admin.game.show', ['game' => $game, 'users' => $users]);
    }


    public function startGame(Game $game)
    {
        $game->pin = str_pad(random_int(0, 999999), 6, '0', STR_PAD_LEFT);
        $game->save();
    }

    public function destroy(Game $game)
    {
        $game->delete();
        return redirect()->route('admin.index')->with('success', 'Game deleted successfully');
    }

    public function storeTeam(Request $request, Game $game)
    {
        $request->validate([
            'color' => 'required|string'
        ]);

        $team = $game->teams()->create([
            'color' => $request->color
        ]);

        return back()->with('success', 'Team added successfully');
    }

    public function destroyTeam(Game $game, Team $team)
    {
        $team->delete();
        return back()->with('success', 'Team deleted successfully');
    }

    public function storeGuest(Request $request, Game $game)
    {
        $request->validate([
            'name' => 'required|string',
            'team_id' => 'required|exists:teams,id'
        ]);

        $guest = Guest::create([
            'name' => ucwords($request->name),
            'team_id' => $request->team_id
        ]);

        return back()->with('success', 'Guest added successfully');
    }

    public function destroyGuest(Game $game, Team $team, Guest $guest)
    {
        $guest->delete();
        return back()->with('success', 'Guest removed from team');
    }

    public function destroyEnlistedGuest(Game $game, EnlistedGuests $guest)
    {
        $guest->delete();
        return back()->with('success', 'Guest removed from game');

    }

    public function storeCoach(Request $request, Game $game)
    {
        $request->validate([
            'coach_id' => 'required|exists:users,id'
        ]);

        $game->update([
            'coach_id' => $request->coach_id
        ]);

        return back()->with('success', 'Coach assigned successfully');
    }

    public function removeCoach(Game $game)
    {
        $game->update([
            'coach_id' => null
        ]);

        return back()->with('success', 'Coach removed successfully');
    }
}
