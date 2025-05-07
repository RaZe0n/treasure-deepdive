@extends('layouts.layout')

@section('content')
<div class="min-h-screen bg-gray-50 relative overflow-hidden">
    <!-- Top Wave -->
    <div class="absolute top-0 left-0 right-0 h-32 bg-{{ $kleur }}">
        <svg class="absolute bottom-0 left-0 w-full" viewBox="0 0 1440 320" preserveAspectRatio="none" style="transform: translateY(1px);">
            <path fill="#f9fafb" d="M0,160L60,144C120,128,240,96,360,90.7C480,85,600,107,720,122.7C840,139,960,149,1080,144C1200,139,1320,117,1380,106.7L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
        </svg>
    </div>

    <!-- Bottom Wave -->
    <div class="absolute bottom-0 left-0 right-0 h-32 bg-{{ $kleur }}">
        <svg class="absolute top-0 left-0 w-full" viewBox="0 0 1440 320" preserveAspectRatio="none" style="transform: translateY(-1px) scaleY(-1);">
            <path fill="#f9fafb" d="M0,160L60,144C120,128,240,96,360,90.7C480,85,600,107,720,122.7C840,139,960,149,1080,144C1200,139,1320,117,1380,106.7L1440,96L1440,320L1380,320C1320,320,1200,320,1080,320C960,320,840,320,720,320C600,320,480,320,360,320C240,320,120,320,60,320L0,320Z"></path>
        </svg>
    </div>

    <!-- Main Content -->
    <div class="relative min-h-screen px-4 py-8">
        <div class="max-w-md mx-auto flex flex-col items-center justify-center min-h-[calc(100vh-4rem)] gap-8">
            <!-- Color Display -->
            <div class="w-full max-w-[200px] aspect-square rounded-3xl shadow-xl overflow-hidden bg-white">
                <div class="h-full w-full bg-{{ $kleur }} flex items-center justify-center">
                    <span class="text-3xl font-bold text-white">{{ $naam }}</span>
                </div>
            </div>

            <!-- Instructions -->
            <div class="space-y-4 text-center">
                <h1 class="text-2xl font-bold text-gray-800">Vind je teamgenoten!</h1>
                <p class="text-lg text-gray-600">Zoek naar mensen met dezelfde kleur als hierboven</p>
            </div>

            <!-- Team Info -->
            <div class="w-full max-w-[280px] p-6 bg-white rounded-2xl shadow-lg">
                <div class="flex items-center justify-between">
                    <span class="text-gray-600">Team grootte:</span>
                    <span class="text-{{ $kleur }} font-bold text-xl">5</span>
                </div>
            </div>
            <p class="text-gray-600 text-center text-lg mx-6">Ga naar een coach wanneer je team compleet is om te starten</p>
        </div>
    </div>
</div>
@endsection
