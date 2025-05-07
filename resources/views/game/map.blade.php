@extends('layouts.layout')


<div class="h-[100svh] bg-gray-200 px-2">
    <div class="flex justify-center items-center h-full w-full flex-col gap-4">
        <h1 class="text-4xl font-bold">Kaart</h1>
        <div class="h-[90svh] w-full border-yellow-400 border-2 rounded-lg" id="map"></div>
    </div>
</div>
    
@vite('resources/js/map.js')