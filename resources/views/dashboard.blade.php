<x-app-layout>
    <x-slot name="header">
        <div class="max-w-7xl mx-auto">
            <h2 class="text-2xl font-semibold text-[#1b1b18] dark:text-[#EDEDEC] leading-tight">
                Bienvenue, {{ auth()->user()->name }} 👋
            </h2>
            <p class="mt-1 text-sm text-gray-600 dark:text-[#A1A09A]">
                Tableau de bord Mini LMS
            </p>
        </div>
    </x-slot>

    <div class="min-h-screen bg-[#FDFDFC] dark:bg-[#0a0a0a] py-10">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-[#161615] overflow-hidden rounded-2xl shadow-[0px_0px_1px_0px_rgba(0,0,0,0.03),0px_12px_24px_0px_rgba(0,0,0,0.08)] border border-[#e7e5df] dark:border-[#2a2a28] p-8">

                @if(auth()->user()->role === 'admin')
                    <div class="mb-8">
                        <p class="text-gray-700 dark:text-[#EDEDEC] text-base">
                            Vous êtes connecté en tant qu’
                            <span class="font-semibold text-[#f53003] dark:text-[#FF4433]">Administrateur</span>.
                        </p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-[#A1A09A]">
                            Gérez les contenus pédagogiques, les quiz et les notes depuis les accès ci-dessous.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-5">
                        <a href="{{ route('formations.index') }}"
                           class="group rounded-2xl border border-[#ece9e2] dark:border-[#2f2f2c] bg-[#fffdf9] dark:bg-[#1b1b18] p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Formations</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-[#A1A09A]">
                                Gérer les formations disponibles.
                            </p>
                        </a>

                        <a href="{{ route('chapitres.index') }}"
                           class="group rounded-2xl border border-[#ece9e2] dark:border-[#2f2f2c] bg-[#fffdf9] dark:bg-[#1b1b18] p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Chapitres</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-[#A1A09A]">
                                Organiser les chapitres des cours.
                            </p>
                        </a>

                        <a href="{{ route('sous_chapitres.index') }}"
                           class="group rounded-2xl border border-[#ece9e2] dark:border-[#2f2f2c] bg-[#fffdf9] dark:bg-[#1b1b18] p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Sous-chapitres</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-[#A1A09A]">
                                Structurer le contenu pédagogique.
                            </p>
                        </a>

                        <a href="{{ route('quizzes.index') }}"
                           class="group rounded-2xl border border-[#ece9e2] dark:border-[#2f2f2c] bg-[#fffdf9] dark:bg-[#1b1b18] p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Quiz</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-[#A1A09A]">
                                Créer et gérer les quiz.
                            </p>
                        </a>

                        <a href="{{ route('notes.index') }}"
                           class="group rounded-2xl border border-[#ece9e2] dark:border-[#2f2f2c] bg-[#fffdf9] dark:bg-[#1b1b18] p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Notes</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-[#A1A09A]">
                                Consulter et modifier les résultats.
                            </p>
                        </a>

                        <a href="{{ route('generation.create') }}"
                           class="group rounded-2xl border border-[#ece9e2] dark:border-[#2f2f2c] bg-[#fffdf9] dark:bg-[#1b1b18] p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Génération IA</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-[#A1A09A]">
                                Générer automatiquement un cours et un quiz à partir d’une consigne.
                            </p>
                        </a>
                    </div>
                @else
                    <div class="mb-8">
                        <p class="text-gray-700 dark:text-[#EDEDEC] text-base">
                            Vous êtes connecté en tant qu’
                            <span class="font-semibold text-green-600">Apprenant</span>.
                        </p>
                        <p class="mt-2 text-sm text-gray-500 dark:text-[#A1A09A]">
                            Accédez rapidement à vos quiz et à vos résultats.
                        </p>
                    </div>

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                        <a href="{{ route('apprenant.quiz', 1) }}"
                           class="group rounded-2xl border border-[#ece9e2] dark:border-[#2f2f2c] bg-[#fffdf9] dark:bg-[#1b1b18] p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Passer un quiz</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-[#A1A09A]">
                                Répondez aux quiz disponibles.
                            </p>
                        </a>

                        <a href="{{ route('notes.mes_notes') }}"
                           class="group rounded-2xl border border-[#ece9e2] dark:border-[#2f2f2c] bg-[#fffdf9] dark:bg-[#1b1b18] p-6 transition hover:-translate-y-0.5 hover:shadow-lg">
                            <p class="text-lg font-semibold text-[#1b1b18] dark:text-[#EDEDEC]">Mes notes</p>
                            <p class="mt-2 text-sm text-gray-600 dark:text-[#A1A09A]">
                                Consultez vos résultats et votre progression.
                            </p>
                        </a>
                    </div>
                @endif

            </div>
        </div>
    </div>
</x-app-layout>