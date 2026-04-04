<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">{{ $quiz->titre }}</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <p class="mb-6"><span class="font-semibold">Sous-chapitre :</span> {{ $quiz->sousChapitre->titre }}</p>

                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Questions</h3>
                    <a href="{{ route('questions.create', ['quiz_id' => $quiz->id]) }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                        + Nouvelle question
                    </a>
                </div>

                @forelse($quiz->questions as $question)
                    <div class="border rounded p-4 mb-4">
                        <div class="flex justify-between items-start">
                            <p class="font-semibold mb-2">{{ $question->question }}</p>
                            <form action="{{ route('questions.destroy', $question->id) }}" method="POST" onsubmit="return confirm('Supprimer cette question ?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 text-sm hover:underline">Supprimer</button>
                            </form>
                        </div>
                        <ul class="ml-4">
                            @foreach($question->reponses as $reponse)
                                <li class="{{ $reponse->est_correcte ? 'text-green-600 font-semibold' : 'text-gray-600' }}">
                                    {{ $reponse->est_correcte ? '✓' : '•' }} {{ $reponse->texte }}
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @empty
                    <p class="text-gray-500">Aucune question pour l'instant.</p>
                @endforelse

                <div class="mt-6">
                    <a href="{{ route('quizzes.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Retour</a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>