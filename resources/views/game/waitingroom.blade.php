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