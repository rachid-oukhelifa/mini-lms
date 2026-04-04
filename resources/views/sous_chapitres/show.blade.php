<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $sousChapitre->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <div class="mb-6">
                    <p><span class="font-semibold">Chapitre :</span> {{ $sousChapitre->chapitre->titre }}</p>
                    <div class="mt-4 prose max-w-none">
                        {!! nl2br(e($sousChapitre->contenu)) !!}
                    </div>
                </div>

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Contenus</h3>
                </div>

                @forelse($sousChapitre->contenus as $contenu)
                    <div class="border rounded p-4 mb-2 hover:bg-gray-50">
                        <p class="font-semibold">{{ $contenu->titre }}</p>
                        <p class="text-gray-500 text-sm">{{ $contenu->texte ?? '' }}</p>
                    </div>
                @empty
                    <p class="text-gray-500">Aucun contenu pour l'instant.</p>
                @endforelse

                <div class="mt-6">
                    <a href="{{ route('sous_chapitres.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>