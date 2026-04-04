<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ $quiz->titre }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <form action="{{ route('apprenant.quiz.submit', $quiz->id) }}" method="POST">
                    @csrf

                    @foreach($quiz->questions as $index => $question)
                    <div class="mb-6 border rounded p-4">
                        <p class="font-semibold mb-3">{{ $index + 1 }}. {{ $question->question }}</p>
                        @foreach($question->reponses as $reponse)
                        <div class="flex items-center gap-2 mb-2">
                            <input type="radio" name="reponse_{{ $question->id }}" value="{{ $reponse->id }}" required>
                            <label>{{ $reponse->texte }}</label>
                        </div>
                        @endforeach
                    </div>
                    @endforeach

                    <button type="submit" class="bg-green-500 text-white px-6 py-2 rounded hover:bg-green-600">
                        Soumettre le quiz
                    </button>
                </form>

            </div>
        </div>
    </div>
</x-app-layout>