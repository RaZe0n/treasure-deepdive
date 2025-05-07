@extends('layouts.layout')

@section('content')

<div class="bg-[url('../../public/img/background1.png')] bg-cover bg-center">
    <div class="flex justify-end">
        <button class="underline mt-2 mr-2 p-2">Coach</button>
    </div>
    <div class="flex justify-center items-center min-h-screen flex-col">
        <div class="flex items-center justify-evenly h-64 flex-col w-full">
            <div class="flex justify-evenly items-center h-3/5 w-1/2 flex-col">
                <h1 class="text-6xl font-IMfell">Stadsbingo</h1>
            </div>
            <div class="flex justify-evenly items-center h-3/5 w-3/5 flex-col p-1">
                    <input type="text" placeholder="Vul de pin in" class="border-2 border-gray-300 rounded-lg mb-2 w-full font-Nunito text-xl">
                    <button class="bg-[#3289BB] rounded w-full font-Nunito text-3xl">Doorgaan</button>
            </div>
        </div>
    </div> 
</div>

@endsection