<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Nouveau quiz</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('quizzes.store') }}" method="POST">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Titre</label>
                        <input type="text" name="titre" value="{{ old('titre') }}"
                            class="w-full border rounded px-3 py-2 @error('titre') border-red-500 @enderror">
                        @error('titre')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Sous-chapitre</label>
                        <select name="sous_chapitre_id" class="w-full border rounded px-3 py-2 @error('sous_chapitre_id') border-red-500 @enderror">
                            <option value="">-- Choisir un sous-chapitre --</option>
                            @foreach($sousChapitres as $sousChapitre)
                                <option value="{{ $sousChapitre->id }}" {{ old('sous_chapitre_id') == $sousChapitre->id ? 'selected' : '' }}>
                                    {{ $sousChapitre->chapitre->titre }} → {{ $sousChapitre->titre }}
                                </option>
                            @endforeach
                        </select>
                        @error('sous_chapitre_id')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Créer</button>
                        <a href="{{ route('quizzes.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>