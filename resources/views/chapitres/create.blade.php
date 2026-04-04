<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nouveau chapitre
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('chapitres.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Formation</label>
                        <select name="formation_id" class="w-full border rounded px-3 py-2 @error('formation_id') border-red-500 @enderror">
                            <option value="">-- Choisir une formation --</option>
                            @foreach($formations as $formation)
                                <option value="{{ $formation->id }}" {{ old('formation_id') == $formation->id ? 'selected' : '' }}>
                                    {{ $formation->nom }}
                                </option>
                            @endforeach
                        </select>
                        @error('formation_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Titre</label>
                        <input type="text" name="titre" value="{{ old('titre') }}"
                            class="w-full border rounded px-3 py-2 @error('titre') border-red-500 @enderror">
                        @error('titre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Description</label>
                        <textarea name="description" rows="4"
                            class="w-full border rounded px-3 py-2">{{ old('description') }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Créer
                        </button>
                        <a href="{{ route('chapitres.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">
                            Annuler
                        </a>
                    </div>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>