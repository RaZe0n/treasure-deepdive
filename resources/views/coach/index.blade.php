@extends('layouts.layout')

@section('content')
<div class="grid grid-cols-1 md:grid-cols-5 min-h-screen">
    <!-- Sidebar -->
    <div class="col-span-1">
        <x-coach.header></x-coach.header>
    </div>

    <!-- Main Content -->
    <div class="col-span-1 md:col-span-4 p-4 md:p-6">
        <!-- Large Card - Game Setup -->
        <div class="bg-white rounded-xl shadow-lg p-4 md:p-6 mb-4 md:mb-6">
            <h2 class="text-xl md:text-2xl font-bold mb-4">Nieuwe Game Starten</h2>

            <!-- Student Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6 mb-4 md:mb-6">
                <div class="bg-green-50 p-4 rounded-lg">
                    <p class="text-sm text-green-600">Ingeschreven Studenten</p>
                    <p id="hoeveel" class="text-xl md:text-2xl font-bold">24</p>
                    <div class="mt-2 space-y-1">
                        <div class="transition-all duration-300 ease-in-out" x-data="{ expanded: false }">
                            <div class="space-y-1" :class="{ 'max-h-24 overflow-hidden': !expanded }">
                                <p class="text-sm">• Jan Jansen</p>
                                <p class="text-sm">• Lisa de Vries</p>
                                <p class="text-sm">• Mohammed Ali</p>
                                <p class="text-sm">• Emma Bakker</p>
                                <p class="text-sm">• Thomas Visser</p>
                                <p class="text-sm">• Sarah Meijer</p>
                                <p class="text-sm">• David Smit</p>
                                <p class="text-sm">• Anna de Boer</p>
                                <p class="text-sm">• Lucas Jansen</p>
                                <p class="text-sm">• Sophie de Vries</p>
                                <p class="text-sm">• Noah Ali</p>
                                <p class="text-sm">• Julia Bakker</p>
                            </div>
                            <button
                                @click="expanded = !expanded"
                                class="text-sm text-green-600 hover:text-green-700 mt-2 flex items-center gap-1"
                            >
                                <span x-text="expanded ? 'Minder tonen' : 'Meer lezen'"></span>
                                <svg
                                    class="w-4 h-4 transition-transform duration-300"
                                    :class="{ 'rotate-180': expanded }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="bg-red-50 p-4 rounded-lg">
                    <p class="text-sm text-red-600">Nog Niet Ingeschreven</p>
                    <p class="text-xl md:text-2xl font-bold">6</p>
                    <div class="mt-2 space-y-1">
                        <div class="transition-all duration-300 ease-in-out" x-data="{ expanded: false }">
                            <div class="space-y-1" :class="{ 'max-h-24 overflow-hidden': !expanded }">
                                <p class="text-sm">• Thomas Visser</p>
                                <p class="text-sm">• Sarah Meijer</p>
                                <p class="text-sm">• David Smit</p>
                                <p class="text-sm">• Anna de Boer</p>
                                <p class="text-sm">• Lucas Jansen</p>
                                <p class="text-sm">• Sophie de Vries</p>
                            </div>
                            <button
                                @click="expanded = !expanded"
                                class="text-sm text-red-600 hover:text-red-700 mt-2 flex items-center gap-1"
                            >
                                <span x-text="expanded ? 'Minder tonen' : 'Meer lezen'"></span>
                                <svg
                                    class="w-4 h-4 transition-transform duration-300"
                                    :class="{ 'rotate-180': expanded }"
                                    fill="none"
                                    stroke="currentColor"
                                    viewBox="0 0 24 24"
                                >
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                                </svg>
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Group Configuration -->
            <div class="bg-gray-50 p-4 rounded-lg mb-4 md:mb-6">
                <h3 class="text-lg font-semibold mb-4">Groepsconfiguratie</h3>
                <form id="groupForm" class="flex flex-col md:flex-row items-start md:items-center gap-4">
                    @csrf
                    @method('post')
                    <div class="w-full md:flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Groepsgrootte</label>
                        <select name="groupSize" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500">
                            <option value="2">2 personen</option>
                            <option value="3">3 personen</option>
                            <option value="4">4 personen</option>
                            <option value="5">5 personen</option>
                            <option value="6">6 personen</option>
                        </select>
                    </div>
                    <div class="w-full md:flex-1">
                        <label class="block text-sm font-medium text-gray-700 mb-2">Aantal groepen</label>
                        <input id="groepen" type="number" class="w-full rounded-lg border-gray-300 shadow-sm focus:border-blue-500 focus:ring-blue-500" placeholder="Aantal groepen" name="groupsAmount">
                        <div class="m-2" id="personen"></div>
                    </div>
                    <div class="w-full md:w-auto">
                        <button type="submit" class="w-full md:w-auto bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition">
                            Groepen Genereren
                        </button>
                    </div>
                </form>
                <div class="mt-4">
                    <button id="redirectGuests" class="w-full md:w-auto bg-green-500 text-white px-6 py-2 rounded-lg hover:bg-green-600 transition">
                        Mensen Doorlaten
                    </button>
                </div>
            </div>
        </div>

        <!-- Smaller Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 md:gap-6">
            <!-- Card 1 -->
            <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                <h3 class="text-lg md:text-xl font-semibold mb-4">Recente Meldingen</h3>
                <div class="space-y-3">
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-green-500 rounded-full"></div>
                        <p>Groep 1 heeft de opdracht voltooid</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-blue-500 rounded-full"></div>
                        <p>Groep 2 is de hunt begonnen!</p>
                    </div>
                    <div class="flex items-center gap-3">
                        <div class="w-2 h-2 bg-yellow-500 rounded-full"></div>
                        <p>Groep 3 heeft een hint opgevraagd</p>
                    </div>
                </div>
            </div>

            <!-- Card 2 -->
            <div class="bg-white rounded-xl shadow-lg p-4 md:p-6">
                <h3 class="text-lg md:text-xl font-semibold mb-4">Actieve Games</h3>
                <div class="space-y-3">
                    <div class="flex justify-between items-center">
                        <p>25SDG </p>
                        <span class="text-sm text-gray-500">45 min bezig</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <p>25SDB</p>
                        <span class="text-sm text-gray-500">30 min bezig</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <p>Techniek25</p>
                        <span class="text-sm text-gray-500">15 min bezig</span>
                    </div>
                </div>
            </div>

            <!-- Full Width Card - Wachtend op Goedkeuring -->
            <div class="col-span-1 md:col-span-2 bg-white rounded-xl shadow-lg p-4 md:p-6">
                <div class="flex items-center justify-center">
                    <div class="text-center">
                        <h3 class="text-lg md:text-xl font-semibold mb-4">Groepen die wachtenten op Goedkeuring</h3>
                        <div class="relative">
                            <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 rounded-full animate-ping opacity-75"></span>
                            <span class="absolute -top-1 -right-1 h-4 w-4 bg-red-500 rounded-full"></span>
                            <p class="text-4xl md:text-6xl font-bold text-red-500">3</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.getElementById('groupForm').addEventListener('submit', function(e) {
    e.preventDefault();
    
    const formData = new FormData(this);
    const data = {
        groupSize: formData.get('groupSize'),
        groupsAmount: formData.get('groupsAmount')
    };
    
    console.log('Submitting form with data:', data);
    
    fetch('/coach', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify(data)
    })
    .then(response => {
        console.log('Response status:', response.status);
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.message === 'Groups assigned successfully') {
            // Show success message
            alert('Groepen zijn succesvol gegenereerd!');
            // Redirect all guests to their group color page
            window.location.href = '/redirect-guests';
        } else {
            throw new Error('Unexpected response message');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Er is een fout opgetreden bij het genereren van de groepen: ' + error.message);
    });
});

document.getElementById('redirectGuests').addEventListener('click', function() {
    console.log('Redirect button clicked');
    fetch('/redirect-guests-without-groups', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        }
    })
    .then(response => {
        console.log('Response status: hallo', response.status);
        return response.json();
    })
    .then(data => {
        console.log('Response data:', data);
        if (data.success) {
            console.log('Redirect flag set successfully');
            alert('Gasten worden doorgestuurd!');
        } else {
            console.error('Error in response:', data.error);
            throw new Error(data.error || 'Er is een fout opgetreden');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('Er is een fout opgetreden: ' + error.message);
    });
});
</script>
@endpush

@vite("resources/js/personen.js")