<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Résultat — {{ $quiz->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="text-center mb-8">
                    <p class="text-4xl font-bold {{ $score == $total ? 'text-green-600' : 'text-blue-600' }}">
                        {{ $score }} / {{ $total }}
                    </p>
                    <p class="text-gray-500 mt-2">
                        {{ round($score / $total * 100) }}% de bonnes réponses
                    </p>
                </div>

                @foreach($resultats as $resultat)
                <div class="border rounded p-4 mb-3 {{ $resultat['ok'] ? 'border-green-300 bg-green-50' : 'border-red-300 bg-red-50' }}">
                    <p class="font-semibold mb-1">{{ $resultat['question'] }}</p>
                    <p class="text-sm">Ta réponse : <span class="{{ $resultat['ok'] ? 'text-green-600' : 'text-red-600' }} font-semibold">{{ $resultat['choisie'] }}</span></p>
                    @if(!$resultat['ok'])
                        <p class="text-sm">Bonne réponse : <span class="text-green-600 font-semibold">{{ $resultat['correcte'] }}</span></p>
                    @endif
                </div>
                @endforeach

                <div class="mt-6">
                    <a href="{{ route('dashboard') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour au tableau de bord</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>