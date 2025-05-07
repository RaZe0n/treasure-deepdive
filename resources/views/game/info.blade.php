@extends('layouts.layout')

@section('content')

<div class="bg-[url('../../public/img/background3.png')] bg-cover bg-center h-screen">
    <div class="flex flex-col justify-center items-center h-screen gap-4">
        <h1 class="text-center text-2xl font-chakra p-10">Je gaat straks door de stad heen lopen.</h1>
        <p class="text-center text-2xl">Tijdens het lopen krijg je op je scherm vragen te zien</p>
        <p class="text-center text-2xl p-5">Beantwoord deze vragen om punten te verdienen. </p>
        <p class="text-center text-2xl p-5">Op de volgende pagina krijg je een oefenvraag </p>
        <a href="#" class="bg-[#3289BB] border-black border border-solid rounded-full p-2 w-2/3 text-center"><p>Start spel</p></a>
    </div>
</div>

@endsection