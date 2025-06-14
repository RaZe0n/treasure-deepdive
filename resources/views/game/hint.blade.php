@extends('layouts.layout')

@section('content')

<div class="bg-[url('../../public/img/hint.png')] bg-cover bg-center h-screen">
    <div class="flex flex-col justify-center items-center h-screen gap-4">
        <h1 class="text-center text-5xl font-chakra p-10">Hint</h1>
        <p class="text-center text-3xl p-10">Bij het standbeeld zit een bordje met informatie</p>
        <a class="p-3 bg-red-500 w-1/2 text-center rounded-md text-white font-bold text-xl" href="javascript:history.back()">Terug</a>
    </div>
</div>

@endsection