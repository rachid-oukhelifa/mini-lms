<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier la formation
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('formations.update', $formation) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Nom</label>
                        <input type="text" name="nom" value="{{ old('nom', $formation->nom) }}"
                            class="w-full border rounded px-3 py-2 @error('nom') border-red-500 @enderror">
                        @error('nom')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Niveau</label>
                        <input type="text" name="niveau" value="{{ old('niveau', $formation->niveau) }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full border rounded px-3 py-2">{{ old('description', $formation->description) }}</textarea>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Durée (heures)</label>
                        <input type="number" name="duree" value="{{ old('duree', $formation->duree) }}"
                            class="w-full border rounded px-3 py-2">
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">
                            Modifier
                        </button>
                        <a href="{{ route('formations.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                            Annuler
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>