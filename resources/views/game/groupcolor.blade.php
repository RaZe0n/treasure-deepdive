@extends('layouts.layout')

@section('content')

<div class="bg-[url('../../public/img/background.png')] relative max-h-screen h-screen px-4 ">
    <div class="flex justify-center items-center flex-col h-full gap-8 text-center text-xl">
        <h1>Ga opzoek naar jouw teamgenoten!</h1>
        <h2>Jouw teamgenoten hebben dezelfde kleur als hieronder</h2>
        <div class="px-16 py-4 bg-red-500 rounded-lg font-bold">
            <p>Rood</p>
        </div>
        <p>Wanneer jullie compleet zijn kunnen jullie starten bij een coach</p>
        <p>Aantal teamgenoten: <span class="text-red-500 font-bold">5</span></p>
    </div>
</div>

@endsection
