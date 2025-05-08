@extends('layouts.layout')

@section('content')
    <div class="min-h-screen bg-gray-50 relative overflow-hidden">
        <!-- Top Wave -->
        <div class="absolute top-0 left-0 right-0 h-32 bg-{{ $kleur }}">
            <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 320" preserveAspectRatio="none"
                style="transform: translateY(1px);">
                <path fill="#f9fafb"
                    d="M0,160L60,144C120,128,240,96,360,90.7C480,85,600,107,720,122.7C840,139,960,149,1080,144C1200,139,1320,117,1380,106.7L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                </path>
            </svg>
        </div>

        <!-- Bottom Wave -->
        <div class="absolute bottom-0 left-0 right-0 h-32 bg-{{ $kleur }}">
            <svg class="absolute top-0 left-0 w-full" viewBox="0 0 1440 320" preserveAspectRatio="none"
                style="transform: translateY(-1px) scaleY(-1);">
                <path fill="#f9fafb"
                    d="M0,160L60,144C120,128,240,96,360,90.7C480,85,600,107,720,122.7C840,139,960,149,1080,144C1200,139,1320,117,1380,106.7L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z">
                </path>
            </svg>
        </div>

        <div class="relative min-h-screen px-4 py-8">
            <div class="max-w-md mx-auto flex flex-col items-center justify-center min-h-[calc(100vh-4rem)] gap-4">
                <div class="space-y-4 text-center">
                    <h1 class="text-2xl font-bold text-gray-800">Uit welk jaar komt het Peerd van Ome Loeks?</h1>
                    <p class="text-lg text-gray-600">Ga naar het hoofdstation en maak een foto van het Peerd van Ome Loeks
                        waar het jaartal duidelijk zichtbaar op is.</p>
                </div>
                <div class="w-full max-w-[240px] rounded-3xl shadow-xl overflow-hidden bg-white">
                    <img class="object-fit" src="/img/Peerd_van_ome_Loeks_Groningen.jpg" alt="">
                </div>
                <form action="post">
                    <div class="w-[380px] p-3 bg-white rounded-2xl shadow-lg">
                        <div class="flex items-center justify-around gap-4 w-full">
                            <div
                                class="w-20 h-20 flex flex-col justify-center items-center border border-gray-300 rounded-lg cursor-pointer">
                                <input type="file" name="image" id="image" class="hidden">
                                <label for="image" class="cursor-pointer hover:text-gray-600 transition-colors">
                                    <svg class="w-10 h-10 text-gray-400" xmlns="http://www.w3.org/2000/svg" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M12 4v16m8-8H4" />
                                    </svg>
                                </label>
                            </div>
                            <p class="text-gray-500 text-sm">Klik om een afbeelding te uploaden</p>
                        </div>
                    </div>
                    <div class="flex justify-center w-full">
                        <input
                            class="w-1/2 p-3 bg-{{ $kleur }} shadow-xl rounded-lg mt-4 text-white font-bold text-xl"
                            type="submit" value="Verstuur">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- hint -->
    <div class="absolute bottom-8 left-8">
        <a class="p-3 bg-slate-200 rounded-md shadow-xl w-1/3 text-center font-semibold opacity-50/"
        href="">
        <i class="fa-solid fa-lightbulb mr-2"></i>Hint</a>
    </div>
    <!-- kaart -->
    <div class="absolute bottom-8 right-8">
        <a class="p-3 bg-slate-200 rounded-md shadow-xl w-1/3 text-center font-semibold" href="">
            <i class="fa-solid fa-map mr-2"></i>Kaart</a>
    </div>
@endsection
