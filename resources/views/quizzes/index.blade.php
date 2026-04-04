<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Quiz</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            @if(session('success'))
                <div class="bg-green-100 text-green-800 p-4 rounded mb-4">{{ session('success') }}</div>
            @endif

            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h3 class="text-lg font-semibold">Liste des quiz</h3>
                    <a href="{{ route('quizzes.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">+ Nouveau quiz</a>
                </div>

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Titre</th>
                            <th class="py-2">Sous-chapitre</th>
                            <th class="py-2">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($quizzes as $quiz)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2">{{ $quiz->titre }}</td>
                            <td class="py-2">{{ $quiz->sousChapitre->titre }}</td>
                            <td class="py-2 flex gap-2">
                                <a href="{{ route('quizzes.show', $quiz) }}" class="text-blue-500 hover:underline">Voir</a>
                                <a href="{{ route('quizzes.edit', $quiz) }}" class="text-yellow-500 hover:underline">Modifier</a>
                                <form action="{{ route('quizzes.destroy', $quiz) }}" method="POST" onsubmit="return confirm('Supprimer ?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="3" class="py-4 text-center text-gray-500">Aucun quiz pour l'instant.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>