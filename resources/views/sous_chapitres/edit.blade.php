<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Modifier le sous-chapitre
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('sous_chapitres.update', $sousChapitre) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Chapitre</label>
                        <select name="chapitre_id" class="w-full border rounded px-3 py-2">
                            <option value="">-- Choisir un chapitre --</option>
                            @foreach($chapitres as $chapitre)
                                <option value="{{ $chapitre->id }}" {{ old('chapitre_id', $sousChapitre->chapitre_id) == $chapitre->id ? 'selected' : '' }}>
                                    {{ $chapitre->formation->nom }} → {{ $chapitre->titre }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Titre</label>
                        <input type="text" name="titre" value="{{ old('titre', $sousChapitre->titre) }}"
                            class="w-full border rounded px-3 py-2 @error('titre') border-red-500 @enderror">
                        @error('titre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Contenu</label>
                        <textarea name="contenu" rows="6"
                            class="w-full border rounded px-3 py-2">{{ old('contenu', $sousChapitre->contenu) }}</textarea>
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</button>
                        <a href="{{ route('sous_chapitres.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>