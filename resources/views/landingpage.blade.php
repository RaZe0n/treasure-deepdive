@extends('layouts.layout')

@section('content')

<div class="bg-[url('../../public/img/background1.png')] bg-cover bg-center object-cover max-h-screen h-screen">
    <div class="absolute right-4">
        <button class="underline mt-2 mr-2 p-2">Coach</button>
    </div>
    <div class="flex justify-center items-center flex-col h-full">
        <div class="flex items-center justify-evenly flex-col w-full">
            <div class="flex justify-evenly items-center h-3/5 w-3/5 flex-col">
                <h1 class="text-4xl text-center font-chakra">Welkom bij de stadsbingo!</h1>
            </div>
            <div class="flex justify-evenly items-center h-3/5 w-3/5 flex-col p-1">
                    <input type="text" placeholder="Vul de pin in" class="border-2 border-gray-300 rounded-lg mb-2 w-full font-Nunito text-xl">
                    <a class="bg-[#3289BB] rounded w-full text-3xl text-center block p-2" href="{{ url('/name') }}">Doorgaan</a>
            </div>
        </div>
    </div> 
</div>

@endsection