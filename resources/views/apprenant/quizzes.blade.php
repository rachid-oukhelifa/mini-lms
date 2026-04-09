<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Passer un quiz
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-semibold mb-4">Quiz disponibles</h3>

                @forelse($quizzes as $quiz)
                    <div class="border rounded p-4 mb-4">
                        <h4 class="text-lg font-bold">{{ $quiz->titre }}</h4>
                        <p class="text-gray-600">
                            Sous-chapitre : {{ $quiz->sousChapitre->titre ?? 'Non défini' }}
                        </p>

                        <a href="{{ route('apprenant.quiz', $quiz->id) }}"
                           class="inline-block mt-3 bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                            Ouvrir le quiz
                        </a>
                    </div>
                @empty
                    <p class="text-gray-500">Aucun quiz disponible.</p>
                @endforelse
            </div>
        </div>
    </div>
</x-app-layout>