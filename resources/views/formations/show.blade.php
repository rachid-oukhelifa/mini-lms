<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $formation->nom }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <p><span class="font-semibold">Niveau :</span> {{ $formation->niveau ?? '-' }}</p>
                    <p><span class="font-semibold">Durée :</span> {{ $formation->duree ?? '-' }} h</p>
                    <p><span class="font-semibold">Description :</span> {{ $formation->description ?? '-' }}</p>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Chapitres</h3>
                    <a href="#" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Nouveau chapitre
                    </a>
                </div>

                @forelse($formation->chapitres as $chapitre)
                    <div class="border rounded p-4 mb-2 hover:bg-gray-50">
                        <p class="font-semibold">{{ $chapitre->titre }}</p>
                        <p class="text-gray-500 text-sm">{{ $chapitre->description ?? '' }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Aucun chapitre pour l'instant.</p>
                @endforelse

                <div class="mt-6">
                    <a href="{{ route('formations.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                        Retour
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>