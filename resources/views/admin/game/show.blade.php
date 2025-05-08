@extends('layouts.layout')

@section('title', 'Game Details - ' . $game->name)

@section('content')
<!-- Toast Notifications -->
@if(session('success'))
    <x-toast :message="session('success')" type="success" />
@endif


@if(session('error'))
    <x-toast :message="session('error')" type="error" />
@endif



<div class="min-h-screen p-4 md:p-6">
    <!-- Header with Game Info -->
    <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 mb-6">
        <div class="flex justify-between items-center">
            <h1 class="text-2xl md:text-3xl font-bold">{{ $game->name }}</h1>
            <a href="{{ route('admin.index') }}" class="text-gray-600 hover:text-gray-800">
                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                </svg>
            </a>
        </div>
    </div>



    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
        <!-- Team Management -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
            <h2 class="text-xl font-bold mb-4">Spelleider Selecteren</h2>
            
            <!-- Coach Selection Form -->
            <form action="{{ route('admin.game.coach.store', $game) }}" method="POST" class="mb-6">
                @csrf
                <div class="flex gap-2">
                    <select name="coach_id" class="flex-1 rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                        @foreach($users as $user)
                        @if($user->role !== 'admin')
                        <option value="{{ $user->id }}" {{ $game->coach_id == $user->id ? 'selected' : '' }}>
                            {{ $user->name }}
                        </option>
                        @endif
                        @endforeach
                    </select>
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg hover:bg-blue-600 transition">
                        Spelleider Toewijzen
                    </button>
                </div>
            </form>

            <!-- Display Selected Coach -->
            @if($game->coach)
            <div class="bg-gray-50 rounded-lg p-4">
                <div class="flex justify-between items-center">
                    <div>
                        <h3 class="font-semibold text-lg">Huidige Spelleider</h3>
                        <p class="text-gray-600">{{ $game->teamGids->name }}</p>
                    </div>
                    <form action="{{ route('admin.game.coach.remove', $game) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="text-red-500 hover:text-red-600">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                        </button>
                    </form>
                </div>
            </div>
            @else
            <p class="text-gray-500 text-center py-4">Nog geen spelleider geselecteerd</p>
            @endif

            <!-- Teams List -->
            <div class="space-y-4">
                @forelse($game->teams as $team)
                <div class="bg-gray-50 rounded-lg p-4">
                    <div class="flex justify-between items-center mb-3">
                        <h3 class="font-semibold capitalize">{{ $team->color }} Team</h3>
                        <form action="{{ route('admin.game.team.destroy', [$game, $team]) }}" method="POST" class="inline"
                            onsubmit="return confirm('Weet je zeker dat je dit team wilt verwijderen?');">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    <!-- Team Members -->
                    <div class="space-y-2">
                        @foreach($team->guests as $guest)
                        <div class="flex justify-between items-center">
                            <span>{{ $guest->name }}</span>
                            <form action="{{ route('admin.game.guest.destroy', [$game, $team, $guest]) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                        @endforeach
                    </div>
                </div>
                @empty
                <p class="text-gray-500 text-center py-4">Nog geen teams aangemaakt</p>
                @endforelse
            </div>
        </div>

        <!-- Guest Management -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
            <h2 class="text-xl font-bold mb-4">Deelnemers</h2>
            
            <!-- Add Guest Form -->
            <form action="{{ route('admin.game.guest.store', $game) }}" method="POST" class="mb-6">
                @csrf
                <div class="space-y-4">
                    <div>
                        <label for="guest_name" class="block text-sm font-medium text-gray-700 mb-2">Naam</label>
                        <input type="text" name="name" id="guest_name" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Voer naam in">
                    </div>
                    <div>
                        <label for="class_name" class="block text-sm font-medium text-gray-700 mb-2">Klas</label>
                        <input type="text" name="class_name" id="class_name" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                            placeholder="Voer klas in">
                    </div>
                    <div>
                        <label for="team_id" class="block text-sm font-medium text-gray-700 mb-2">Team</label>
                        <select name="team_id" id="team_id" required
                            class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="">Selecteer een team</option>
                            @foreach($game->teams as $team)
                            <option value="{{ $team->id }}">{{ ucfirst($team->color) }} Team</option>
                            @endforeach
                        </select>
                    </div>
                    <button type="submit" class="w-full bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-600 transition">
                        Deelnemer Toevoegen
                    </button>
                </div>
            </form>

            <!-- Unassigned Guests -->
            <div>
                <h3 class="font-semibold mb-3">Niet-toegewezen Deelnemers</h3>
                <div class="space-y-2">
                    @forelse($game->enlisted_guests as $guest)
                    <div class="flex justify-between items-center bg-gray-50 p-3 rounded-lg">
                        <div>
                            <p class="font-medium">{{ $guest->name }}</p>
                            <p class="text-sm text-gray-500">{{ $guest->class_name }}</p>
                        </div>
                        <form action="{{ route('admin.game.enlisted-guest.destroy', [$game, $guest]) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-red-500 hover:text-red-600">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                    <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                                </svg>
                            </button>
                        </form>
                    </div>
                    @empty
                    <p class="text-gray-500 text-center py-4">Geen niet-toegewezen deelnemers</p>
                    @endforelse
                </div>
            </div>
        </div>
    </div>
</div>
@endsection