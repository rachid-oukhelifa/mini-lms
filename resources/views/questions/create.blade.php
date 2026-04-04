<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Nouvelle question — {{ $quiz->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('questions.store') }}" method="POST">
                    @csrf
                    <input type="hidden" name="quiz_id" value="{{ $quiz->id }}">

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Question</label>
                        <input type="text" name="question" value="{{ old('question') }}"
                            class="w-full border rounded px-3 py-2 @error('question') border-red-500 @enderror">
                        @error('question')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-2 font-semibold">Réponses</label>
                        <p class="text-gray-500 text-sm mb-3">Coche la bonne réponse.</p>

                        @for($i = 0; $i < 4; $i++)
                        <div class="flex items-center gap-3 mb-2">
                            <input type="radio" name="bonne_reponse" value="{{ $i }}" {{ $i == 0 ? 'checked' : '' }}>
                            <input type="text" name="reponses[]" value="{{ old('reponses.'.$i) }}"
                                placeholder="Réponse {{ $i + 1 }}"
                                class="w-full border rounded px-3 py-2">
                        </div>
                        @endfor

                        @error('reponses')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                        @error('bonne_reponse')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Ajouter</button>
                        <a href="{{ route('quizzes.show', $quiz) }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>