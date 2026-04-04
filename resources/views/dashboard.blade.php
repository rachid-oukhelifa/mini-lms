<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Bienvenue, {{ auth()->user()->name }} 👋
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                @if(auth()->user()->role === 'admin')
                    <p class="text-gray-700 mb-6">Vous êtes connecté en tant qu'<span class="font-semibold text-blue-600">Administrateur</span>. Gérez le contenu depuis le menu.</p>
                    <div class="grid grid-cols-2 gap-4 md:grid-cols-3">
                        <a href="{{ route('formations.index') }}" class="bg-blue-50 border border-blue-200 rounded p-4 hover:bg-blue-100 text-center">
                            <p class="font-semibold text-blue-700">Formations</p>
                        </a>
                        <a href="{{ route('chapitres.index') }}" class="bg-blue-50 border border-blue-200 rounded p-4 hover:bg-blue-100 text-center">
                            <p class="font-semibold text-blue-700">Chapitres</p>
                        </a>
                        <a href="{{ route('sous_chapitres.index') }}" class="bg-blue-50 border border-blue-200 rounded p-4 hover:bg-blue-100 text-center">
                            <p class="font-semibold text-blue-700">Sous-chapitres</p>
                        </a>
                        <a href="{{ route('quizzes.index') }}" class="bg-blue-50 border border-blue-200 rounded p-4 hover:bg-blue-100 text-center">
                            <p class="font-semibold text-blue-700">Quiz</p>
                        </a>
                        <a href="{{ route('notes.index') }}" class="bg-blue-50 border border-blue-200 rounded p-4 hover:bg-blue-100 text-center">
                            <p class="font-semibold text-blue-700">Notes</p>
                        </a>
                    </div>
                @else
                    <p class="text-gray-700 mb-6">Vous êtes connecté en tant qu'<span class="font-semibold text-green-600">Apprenant</span>.</p>
                    <div class="grid grid-cols-2 gap-4">
                        <a href="{{ route('apprenant.quiz', 1) }}" class="bg-green-50 border border-green-200 rounded p-4 hover:bg-green-100 text-center">
                            <p class="font-semibold text-green-700">Passer un quiz</p>
                        </a>
                        <a href="{{ route('notes.mes_notes') }}" class="bg-green-50 border border-green-200 rounded p-4 hover:bg-green-100 text-center">
                            <p class="font-semibold text-green-700">Mes notes</p>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>