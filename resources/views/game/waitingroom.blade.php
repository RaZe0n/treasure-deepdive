@extends('layouts.layout')

@section('title', 'Waiting Room')

@section('content')
    <div class="min-h-screen bg-gray-100 flex items-center justify-center">
        <div class="bg-white p-8 rounded-lg shadow-md w-full max-w-md">
            <h1 class="text-2xl font-bold mb-4">Wachtkamer</h1>
            <p class="text-gray-600 mb-4">Wachten tot de coach je doorlaat...</p>
            <div class="flex justify-center">
                <div class="animate-spin rounded-full h-8 w-8 border-b-2 border-gray-900"></div>
            </div>
            <div id="status" class="mt-4 text-center"></div>
            <div id="debug" class="mt-4 text-sm text-gray-500"></div>
            <div id="session" class="mt-4 text-sm text-gray-500"></div>
<div class="h-screen bg-[url('../../public/img/waitingroom.png')] bg-cover bg-center object-cover">
    <div class="flex flex-col justify-center items-center h-screen gap-4">
        <h1 class="text-center text-2xl font-chakra">Welkom Naam!</h1>
        <p class="text-center text-2xl">Je bent aangemeld.</p>
        <p class="text-center text-2xl p-5">Wacht totdat je word ingedeeld in een groepje.</p>
        <div role="status">
            <svg aria-hidden="true" class="inline w-10 h-10 text-gray-200 animate-spin dark:text-gray-600 fill-blue-500" viewBox="0 0 100 101" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z" fill="currentColor"/>
                <path d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z" fill="currentFill"/>
            </svg>
            <span class="sr-only">Loading...</span>
        </div>
    </div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const statusDiv = document.getElementById('status');
        const debugDiv = document.getElementById('debug');
        const sessionDiv = document.getElementById('session');
        
        function showStatus(message) {
            statusDiv.textContent = message;
            statusDiv.className = 'mt-4 text-center text-gray-600';
        }

        function showDebug(message) {
            debugDiv.textContent = message;
            console.log(message);
        }

        function showSession(message) {
            sessionDiv.textContent = message;
            console.log('Session:', message);
        }

        showStatus('Wachten op doorverwijzing...');
        showDebug('Starting redirect check...');
        showSession('Session ID: ' + document.cookie);

        // Check if coach clicked the button every 2 seconds
        function checkRedirect() {
            showDebug('Checking redirect status...');
            fetch('/check-redirect', {
                method: 'GET',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-Requested-With': 'XMLHttpRequest'
                },
                credentials: 'same-origin'
            })
            .then(response => {
                showDebug('Response received: ' + response.status);
                if (!response.ok) {
                    throw new Error('Network response was not ok: ' + response.status);
                }
                return response.json();
            })
            .then(data => {
                showDebug('Data received: ' + JSON.stringify(data));
                if (data.shouldRedirect) {
                    showStatus('Je wordt doorgestuurd...');
                    showDebug('Redirecting to group color page...');
                    window.location.href = '/game/groupcolor/blue/Groep%201';
                } else {
                    showDebug('No redirect yet. Debug info: ' + JSON.stringify(data.debug));
                    showSession('Session data: ' + JSON.stringify(data.debug.session));
                    setTimeout(checkRedirect, 2000);
                }
            })
            .catch(error => {
                showDebug('Error: ' + error.message);
                console.error('Error checking redirect:', error);
                setTimeout(checkRedirect, 2000);
            });
        }

        // Start checking for redirect
        checkRedirect();
    });
</script>
@endpush