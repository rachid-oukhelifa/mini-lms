<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $chapitre->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <p><span class="font-semibold">Formation :</span> {{ $chapitre->formation->nom }}</p>
                    <p><span class="font-semibold">Description :</span> {{ $chapitre->description ?? '-' }}</p>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Sous-chapitres</h3>
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Nouveau sous-chapitre
                    </a>
                </div>

                @forelse($chapitre->sousChapitres as $sousChapitre)
                    <div class="border rounded p-4 mb-2 hover:bg-gray-50">
                        <p class="font-semibold">{{ $sousChapitre->titre }}</p>
                        <p class="text-gray-500 text-sm">{{ $sousChapitre->contenu ?? '' }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Aucun sous-chapitre pour l'instant.</p>
                @endforelse

                <div class="mt-6">
                    <a href="{{ route('chapitres.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                        Retour
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>