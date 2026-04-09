<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Génération de contenu par IA
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg p-6">
                <form method="POST" action="{{ route('generation.store') }}">
                    @csrf

                    <label for="prompt" class="block text-sm font-medium text-gray-700 mb-2">
                        Consigne
                    </label>

                    <textarea
                        id="prompt"
                        name="prompt"
                        rows="8"
                        class="w-full border-gray-300 rounded-lg shadow-sm"
                        placeholder="Exemple : Génère un cours destiné à un niveau Bac+3 sur l’histoire du marketing, structuré en quatre chapitres d’environ 300 mots chacun, suivi d’un quiz de dix questions."
                        required>{{ old('prompt') }}</textarea>

                    @error('prompt')
                        <p class="text-red-600 text-sm mt-2">{{ $message }}</p>
                    @enderror

                    <div class="mt-6">
                        <button
                            type="submit"
                            class="bg-blue-600 hover:bg-blue-700 text-white px-5 py-2 rounded-lg">
                            Générer automatiquement
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>