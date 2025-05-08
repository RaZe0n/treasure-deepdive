@extends('layouts.layout')

@section('content')
    <div class="bg-[url('../../public/img/nameinput.png')] bg-cover bg-center">
        <div class="flex justify-center items-center min-h-screen flex-col">
            <div class="flex items-center justify-evenly h-64 flex-col w-full mt-20">
                <div class="flex justify-evenly items-center h-3/5 w-5/6 flex-col">
                    <h1 class="text-4xl text-center font-chakra">Vul hier je naam in!</h1>
                    @error('error')
                        <p class="text-xl text-center text-red-400">{{ $message }}</p>
                    @enderror
                </div>
                <form action="" method="post" class="flex justify-evenly items-center h-3/5 w-3/5 flex-col p-1">
                    @csrf
                    @method('post')
                    <input type="text" placeholder="Naam + Achternaam" name="name"
                        class="border-2 border-gray-300 rounded-lg mb-2 w-full text-xl p-2">
                    <button type="submit"
                        class="bg-[#3289BB] rounded w-full font-Nunito text-3xl text-center block p-2">Doorgaan</button>
                </form>
            </div>
        </div>
    </div>
@endsection
