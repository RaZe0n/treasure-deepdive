@extends('layouts.layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-5 min-h-screen">
    <!-- Sidebar -->
    <div class="col-span-1">
        <x-coach.header></x-coach.header>
    </div>
    
    <!-- Main Content -->
    <div class="col-span-1 md:col-span-4 p-4 md:p-6">
        <!-- Incoming Work Card -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 mb-6">
            <h2 class="text-xl md:text-2xl font-bold mb-4">Openstaande opdrachten van groep {{ $team->id }}</h2>
            
            <!-- Work Content -->
            <div class="mb-6">
                <div class="bg-gray-50 rounded-lg p-4 mb-4">
                    <img src="https://placehold.co/300x150" alt="Submitted work" class="w-full rounded-lg mb-4">
                    <p class="text-gray-700">Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, quos.</p>
                </div>
                
                <!-- Action Buttons -->
                <div class="flex flex-col gap-4">
                    <div class="text-sm text-gray-500">
                        Ingediend op: {{ now()->format('d-m-Y H:i') }}
                    </div>
                    <div class="flex gap-4">
                        <button class="flex-1 bg-green-500 text-white px-6 py-3 rounded-lg hover:bg-green-600 transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M16.707 5.293a1 1 0 010 1.414l-8 8a1 1 0 01-1.414 0l-4-4a1 1 0 011.414-1.414L8 12.586l7.293-7.293a1 1 0 011.414 0z" clip-rule="evenodd" />
                            </svg>
                            Accepteren
                        </button>
                        <button class="flex-1 bg-red-500 text-white px-6 py-3 rounded-lg hover:bg-red-600 transition flex items-center justify-center gap-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd" />
                            </svg>
                            Afkeuren
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Group Info Card -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
            <h2 class="text-xl md:text-2xl font-bold mb-4">Groep {{ $team->id }}</h2>

            <!-- Group Status -->
            <div class="mb-6">
                <div class="flex items-center gap-2">
                    <span class="absolute h-3 w-3 opacity-75 animate-ping rounded-full bg-green-500"></span>
                    <span class="w-3 h-3 rounded-full bg-green-500"></span>
                    <p class="text-lg font-medium">Spelend</p>
                </div>
            </div>

            <!-- Group Members -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Groepsleden ({{ $teamMembers->count() }})</h3>
                <div class="space-y-2" id="teamMembers" data-id="{{ $team->id }}">
                    @foreach ($teamMembers as $teamMember)
                        @if ($team->guest_id == $teamMember->id)
                        <p class="text-sm cursor-pointer font-bold" data-id="{{ $teamMember->id }}">• {{ $teamMember->name }} (TeamGids)</p>
                        @else
                            <p class="text-sm cursor-pointer" data-id="{{ $teamMember->id }}">• {{ $teamMember->name }}</p>
                        @endif
                    @endforeach
                </div>
            </div>

            <!-- Progress -->
            <div class="mb-6">
                <h3 class="text-lg font-semibold mb-3">Voortgang</h3>
                <div class="w-full bg-gray-200 rounded-full h-2.5">
                    <div class="bg-blue-600 h-2.5 rounded-full" style="width: 45%"></div>
                </div>
                <p class="text-sm text-gray-600 mt-2">45% voltooid</p>
            </div>

            <!-- Recent Activity -->
            <div>
                <h3 class="text-lg font-semibold mb-3">Recente Activiteit</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <p>Opdracht 1 voltooid</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <p>Opdracht 2 gestart</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <p>Hint voor opdracht 2 gevraagd</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@vite('resources/js/group.js')

@endsection