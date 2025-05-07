@extends('layouts.layout')

@section('title', 'Admin Dashboard')

@section('content')
<!-- Toast Notifications -->
@if(session('success'))
    <x-toast :message="session('success')" type="success" />
@endif

@if(session('error'))
    <x-toast :message="session('error')" type="error" />
@endif

<div class="grid grid-cols-1 min-h-screen">
    <!-- Main Content -->
    <div class="p-4 md:p-6">
        <!-- Game Creation Card -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 mb-6">
            <h2 class="text-xl md:text-2xl font-bold mb-4">Nieuwe Game Starten</h2>
            
            <form action="/admin" method="post" class="space-y-4">
                @csrf
                @method('post')
                
                <!-- Game Configuration -->
                <div class="bg-gray-50 p-4 rounded-lg">
                    <div class="grid grid-cols-1 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700 mb-2">Game Naam</label>
                            <input type="text" name="name" id="name" 
                                class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500"
                                placeholder="Voer game naam in">
                        </div>
                    </div>
                </div>

                <button type="submit" 
                    class="w-full md:w-auto bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition flex items-center justify-center gap-2">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z" clip-rule="evenodd" />
                    </svg>
                    Game Aanmaken
                </button>
            </form>
        </div>

        <!-- Active Games Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <!-- Active Games Card -->
            <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                <h3 class="text-lg md:text-xl font-semibold mb-4">Actieve Games</h3>
                <div class="space-y-3" id="active-games">
                    <!-- Active games will be displayed here -->
                    @forelse($activeGames ?? [] as $game)
                    <div class="flex justify-between items-center p-3 bg-gray-50 rounded-lg">
                        <div>
                            <p class="font-medium">{{ $game->name }}</p>
                            <p class="text-sm text-gray-500">{{ $game->enlisted_guests->count() }} deelnemers</p>
                        </div>
                        <div class="flex gap-2">
                            <a href="{{ route('admin.game.show', $game) }}" class="text-blue-500 hover:text-blue-600 p-2">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                    <path d="M13.586 3.586a2 2 0 112.828 2.828l-.793.793-2.828-2.828.793-.793zM11.379 5.793L3 14.172V17h2.828l8.38-8.379-2.83-2.828z" />
                                </svg>
                            </a>
                            <form action="{{ route('admin.game.destroy', $game) }}" method="POST" class="inline"
                                onsubmit="return confirm('Weet je zeker dat je deze game wilt verwijderen?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:text-red-600 p-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                                        <path fill-rule="evenodd" d="M9 2a1 1 0 00-.894.553L7.382 4H4a1 1 0 000 2v10a2 2 0 002 2h8a2 2 0 002-2V6a1 1 0 100-2h-3.382l-.724-1.447A1 1 0 0011 2H9zM7 8a1 1 0 012 0v6a1 1 0 11-2 0V8zm5-1a1 1 0 00-1 1v6a1 1 0 102 0V8a1 1 0 00-1-1z" clip-rule="evenodd" />
                                    </svg>
                                </button>
                            </form>
                        </div>
                    </div>
                    @empty
                    <div class="text-center text-gray-500 py-4">
                        <p>Geen actieve games</p>
                    </div>
                    @endforelse
                </div>
            </div>

            <!-- Game Statistics Card -->
            <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                <h3 class="text-lg md:text-xl font-semibold mb-4">Game Statistieken</h3>
                <div class="space-y-4">
                    <div class="bg-green-50 p-4 rounded-lg">
                        <p class="text-sm text-green-600">Totaal Actieve Games</p>
                        <p class="text-2xl font-bold">{{ $activeGamesCount ?? 0 }}</p>
                    </div>
                    <div class="bg-blue-50 p-4 rounded-lg">
                        <p class="text-sm text-blue-600">Totaal Actieve Teams</p>
                        <p class="text-2xl font-bold">{{ $activeTeamsCount ?? 0 }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection