<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Guest;
use App\Models\Team;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Cache;

class GameController extends Controller
{
    private static $redirectFlags = [];

    private function getRedirectFlagPath($pin)
    {
        return storage_path('app/redirect_flags/' . $pin . '.flag');
    }

    private function setRedirectFlag($pin, $value = true)
    {
        $path = $this->getRedirectFlagPath($pin);
        $dir = dirname($path);

        if (!file_exists($dir)) {
            mkdir($dir, 0755, true);
        }

        file_put_contents($path, $value ? '1' : '0');
    }

    private function getRedirectFlag($pin)
    {
        $path = $this->getRedirectFlagPath($pin);
        return file_exists($path) && file_get_contents($path) === '1';
    }

    private function clearRedirectFlag($pin)
    {
        $path = $this->getRedirectFlagPath($pin);
        if (file_exists($path)) {
            unlink($path);
        }
    }

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

        $isValid = $game->enlisted_guests()->where('name', ucwords($request->name))->exists();

        if (!$isValid) {
            return back()->withErrors(['error' => '"' . $request->name . '" bestaat niet']);
        }

        $guest = Guest::create([
            'name' => strtoupper($request->name),
            'pin' => $game->pin,
        ]);

        // Clear any existing redirect cache for this game
        Cache::forget('game_' . $game->pin . '_redirect');

        Log::info('Guest created and session set', [
            'guest_id' => $guest->id,
            'name' => $guest->name,
            'game_id' => $game->id,
            'game_pin' => $game->pin,
            'cache_cleared' => true
        ]);

        session(['guest_id' => $guest->id]);

        return to_route('waitingRoom');
    }

    public function showWaitingRoom()
    {
        Log::info('GameController: Showing waiting room', [
            'session_id' => session()->getId(),
            'session_guest_id' => session('guest_id'),
            'session_all' => session()->all()
        ]);

        // Ensure guest_id is set in session
        if (!session()->has('guest_id')) {
            Log::warning('GameController: No guest_id in session for waiting room');
            return redirect('/');
        }

        // Ensure session is saved
        session()->save();

        Log::info('GameController: Waiting room session ready', [
            'guest_id' => session('guest_id'),
            'session_id' => session()->getId(),
            'session_all' => session()->all()
        ]);

        return view('game.waitingroom');
    }

    public function color($color = null, $name = null)
    {
        $naam = "Groen";
        $kleur = "green-500";
        return view("game.groupcolor", ["naam" => $naam, "kleur" => $kleur]);
    }

    public function vraag($color = null, $name = null)
    {
        $naam = "Groen";
        $kleur = "green-500";
        return view("game.vraag2", ["naam" => $naam, "kleur" => $kleur]);
    }

    public function createGroups(Request $request)
    {
        try {
            Log::info('createGroups method called', [
                'request_data' => $request->all(),
                'user' => Auth::user(),
                'user_pin' => Auth::user()->pin ?? 'no pin'
            ]);

            $pin = Auth::user()->pin;
            if (!$pin) {
                Log::error('No pin found for authenticated user', [
                    'user' => Auth::user(),
                    'user_id' => Auth::id()
                ]);
                return response()->json(['error' => 'No game pin found for coach'], 400);
            }

            $game = Game::where('pin', $pin)->first();
            if (!$game) {
                Log::error('No game found for pin', [
                    'pin' => $pin,
                    'user' => Auth::user()
                ]);
                return response()->json(['error' => 'No game found for this pin'], 404);
            }

            $guests = Guest::where('pin', $game->pin)->get();
            Log::info('Found guests for game', [
                'game_id' => $game->id,
                'pin' => $game->pin,
                'guest_count' => $guests->count(),
                'guests' => $guests->pluck('name', 'id')->toArray()
            ]);

            if ($guests->isEmpty()) {
                Log::error('No guests found for game', [
                    'game_id' => $game->id,
                    'pin' => $game->pin
                ]);
                return response()->json(['error' => 'No guests found for this game'], 404);
            }

            // Define group colors
            $groupColors = [
                'blue',
                'red',
                'green',
                'yellow',
                'purple',
                'pink'
            ];

            // Calculate group size and number of groups
            $groupSize = $request->input('groupSize', 3);
            $numberOfGroups = ceil($guests->count() / $groupSize);

            Log::info('Group configuration', [
                'group_size' => $groupSize,
                'number_of_groups' => $numberOfGroups,
                'total_guests' => $guests->count()
            ]);

            // Shuffle guests to randomize group assignment
            $shuffledGuests = $guests->shuffle();

            // Assign guests to groups
            $groupAssignments = [];
            for ($i = 0; $i < $numberOfGroups; $i++) {
                $groupAssignments[$i] = [
                    'color' => $groupColors[$i % count($groupColors)],
                    'name' => "Groep " . ($i + 1),
                    'guests' => []
                ];
            }

            // Distribute guests among groups
            $guestIndex = 0;
            foreach ($shuffledGuests as $guest) {
                $groupIndex = $guestIndex % $numberOfGroups;
                $groupAssignments[$groupIndex]['guests'][] = $guest;

                try {
                    // Update guest with group information
                    $guest->group_color = $groupAssignments[$groupIndex]['color'];
                    $guest->group_name = $groupAssignments[$groupIndex]['name'];
                    $saved = $guest->save();

                    Log::info('Guest assigned to group', [
                        'guest_id' => $guest->id,
                        'guest_name' => $guest->name,
                        'group_color' => $guest->group_color,
                        'group_name' => $guest->group_name,
                        'save_success' => $saved
                    ]);

                    // Verify the update
                    $updatedGuest = Guest::find($guest->id);
                    Log::info('Verified guest update', [
                        'guest_id' => $updatedGuest->id,
                        'group_color' => $updatedGuest->group_color,
                        'group_name' => $updatedGuest->group_name
                    ]);
                } catch (\Exception $e) {
                    Log::error('Error updating guest', [
                        'guest_id' => $guest->id,
                        'error' => $e->getMessage(),
                        'trace' => $e->getTraceAsString()
                    ]);
                    throw $e;
                }

                $guestIndex++;
            }

            Log::info('Groups assigned successfully', [
                'group_assignments' => $groupAssignments
            ]);

            return response()->json([
                'message' => 'Groups assigned successfully',
                'groups' => $groupAssignments
            ]);
        } catch (\Exception $e) {
            Log::error('Error in createGroups', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'request_data' => $request->all(),
                'user' => Auth::user()
            ]);
            return response()->json(['error' => 'An error occurred while creating groups: ' . $e->getMessage()], 500);
        }
    }

    public function checkGroupAssignment()
    {
        try {
            $guest = Guest::where('user_id', Auth::id())->first();

            if (!$guest) {
                Log::info('No guest found for user', ['user_id' => Auth::id()]);
                return response()->json(['hasGroup' => false, 'groupsGenerated' => false]);
            }

            // Check if any guests in this game have been assigned to groups
            $hasGroups = Guest::where('pin', $guest->pin)
                ->whereNotNull('group_color')
                ->exists();

            Log::info('Group assignment check', [
                'guest_id' => $guest->id,
                'has_group' => $guest->group_color !== null,
                'groups_generated' => $hasGroups
            ]);

            return response()->json([
                'hasGroup' => $guest->group_color !== null,
                'groupsGenerated' => $hasGroups,
                'color' => $guest->group_color,
                'name' => $guest->group_name
            ]);
        } catch (\Exception $e) {
            Log::error('Error in checkGroupAssignment', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['hasGroup' => false, 'groupsGenerated' => false]);
        }
    }

    public function redirectGuests()
    {
        try {
            $pin = Auth::user()->pin;
            if (!$pin) {
                return redirect('/coach')->with('error', 'No game pin found');
            }

            $game = Game::where('pin', $pin)->first();
            if (!$game) {
                return redirect('/coach')->with('error', 'No game found');
            }

            $guests = Guest::where('pin', $game->pin)->get();
            foreach ($guests as $guest) {
                // Assign a default group if not already assigned
                if (!$guest->group_color || !$guest->group_name) {
                    $guest->group_color = 'blue';
                    $guest->group_name = 'Groep 1';
                    $guest->save();
                }
            }

            return redirect('/coach')->with('success', 'All guests have been redirected to their group pages');
        } catch (\Exception $e) {
            Log::error('Error redirecting guests', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return redirect('/coach')->with('error', 'An error occurred while redirecting guests');
        }
    }

    public function redirectGuestsWithoutGroups()
    {
        try {
            $pin = Auth::user()->pin;
            if (!$pin) {
                Log::error('No pin found for user', ['user_id' => Auth::id()]);
                return response()->json(['error' => 'No game pin found'], 400);
            }

            $game = Game::where('pin', $pin)->first();
            if (!$game) {
                Log::error('No game found for pin', ['pin' => $pin]);
                return response()->json(['error' => 'No game found'], 404);
            }

            // Set redirect flag in cache
            Cache::put('game_' . $pin . '_redirect', true, now()->addMinutes(5));

            Log::info('Redirect flag set in cache', [
                'game_id' => $game->id,
                'pin' => $pin,
                'cache_key' => 'game_' . $pin . '_redirect'
            ]);

            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            Log::error('Error redirecting guests without groups', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['error' => 'An error occurred while redirecting guests'], 500);

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

    public function checkRedirect(Request $request)
    {
        try {
            $guestId = session('guest_id');
            if (!$guestId) {
                Log::info('No guest_id in session', ['session' => session()->all()]);
                return response()->json(['shouldRedirect' => false]);
            }

            $guest = Guest::find($guestId);
            if (!$guest) {
                Log::info('No guest found for ID', ['guest_id' => $guestId]);
                return response()->json(['shouldRedirect' => false]);
            }

            // Check if redirect flag is set in cache
            $shouldRedirect = Cache::get('game_' . $guest->pin . '_redirect', false);

            Log::info('Checking redirect status', [
                'guest_id' => $guest->id,
                'guest_pin' => $guest->pin,
                'should_redirect' => $shouldRedirect,
                'cache_key' => 'game_' . $guest->pin . '_redirect'
            ]);

            return response()->json([
                'shouldRedirect' => $shouldRedirect,
                'debug' => [
                    'guest_pin' => $guest->pin,
                    'cache_key' => 'game_' . $guest->pin . '_redirect'
                ]
            ]);
        } catch (\Exception $e) {
            Log::error('Error in checkRedirect', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
            return response()->json(['shouldRedirect' => false]);
        }
    }
}
