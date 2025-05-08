@extends('layouts.layout')


<div class="h-[100svh] bg-[url('../../public/img/practice.png')] px-2">
    <div class="flex justify-center items-center h-full w-full flex-col gap-4">
        <h1 class="text-4xl font-bold">Kaart</h1>
        <div class="h-[80svh] w-full border-red-500 border-2 rounded-lg" id="map"></div>
        <a class="p-3 bg-red-500 w-1/2 text-center rounded-md text-white font-bold text-xl" href="">Terug</a>
    </div>
</div>
    
@vite('resources/js/map.js')