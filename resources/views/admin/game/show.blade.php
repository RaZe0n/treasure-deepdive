@extends('layouts.layout')

@section('title', 'Edit game')

@section('content')


<div class="flex flex-col items-center justify-center h-screen bg-[#595652]">
    <h1 class="text-2xl font-bold mb-4">Game: {{$game->naam}}</h1>
    <h2 class="text-2xl font-bold mb-4">Users toevoegen</h2>
    <form action="" method="POST" class="space-y-4">
        <div class="flex flex-col">
            <label for="name" class="text-sm font-medium">Naam</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Vul de naam in">
        </div>
        <div class="flex flex-col">
            <label for="class" class="text-sm font-medium">Class</label>
            <input type="text" name="class" id="class" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500 sm:text-sm" placeholder="Vul de class in">
        </div>
        <button type="submit" class="px-4 py-2 bg-indigo-600 text-white text-sm font-medium rounded-md hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2">
            Opslaan
        </button>
    </form>
</div>

@endsection