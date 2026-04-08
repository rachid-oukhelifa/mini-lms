<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mini LMS</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-gradient-to-br from-blue-50 to-indigo-100 min-h-screen flex flex-col">

    <!-- Navbar -->
    <nav class="bg-white shadow-sm px-8 py-4 flex justify-between items-center">
        <div class="flex items-center gap-2">
            <span class="text-2xl font-bold text-blue-700">🎓 Mini LMS</span>
        </div>
        <div class="flex gap-3">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-medium">
                    Dashboard
                </a>
            @else
                <a href="{{ route('login') }}" class="text-gray-600 px-5 py-2 rounded-lg hover:bg-gray-100 font-medium">
                    Se connecter
                </a>
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-5 py-2 rounded-lg hover:bg-blue-700 font-medium">
                    Créer un compte
                </a>
            @endauth
        </div>
    </nav>

    <!-- Hero -->
    <div class="flex-1 flex flex-col items-center justify-center text-center px-6 py-20">
        <span class="bg-blue-100 text-blue-700 text-sm font-semibold px-4 py-1 rounded-full mb-6">
            Plateforme pédagogique Laravel
        </span>
        <h1 class="text-6xl font-extrabold text-gray-900 mb-6 leading-tight">
            Apprenez à votre <br>
            <span class="text-blue-600">propre rythme</span>
        </h1>
        <p class="text-gray-500 text-xl mb-10 max-w-xl">
            Accédez à des formations structurées, testez vos connaissances avec des quiz interactifs et suivez votre progression.
        </p>
        <div class="flex gap-4">
            @auth
                <a href="{{ route('dashboard') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-blue-700 shadow-lg">
                    Accéder au dashboard →
                </a>
            @else
                <a href="{{ route('register') }}" class="bg-blue-600 text-white px-8 py-4 rounded-xl text-lg font-semibold hover:bg-blue-700 shadow-lg">
                    Commencer gratuitement →
                </a>
                <a href="{{ route('login') }}" class="bg-white text-gray-700 px-8 py-4 rounded-xl text-lg font-semibold hover:bg-gray-50 shadow border">
                    Se connecter
                </a>
            @endauth
        </div>
    </div>

    <!-- Features -->
    <div class="bg-white py-20 px-8">
        <div class="max-w-5xl mx-auto grid grid-cols-1 md:grid-cols-3 gap-8">
            <div class="text-center p-8 rounded-2xl bg-blue-50 border border-blue-100">
                <div class="text-5xl mb-4">📚</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Formations</h3>
                <p class="text-gray-500">Contenus organisés en chapitres et sous-chapitres pour un apprentissage progressif.</p>
            </div>
            <div class="text-center p-8 rounded-2xl bg-indigo-50 border border-indigo-100">
                <div class="text-5xl mb-4">🧠</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Quiz interactifs</h3>
                <p class="text-gray-500">Questions à choix multiple avec correction automatique et score instantané.</p>
            </div>
            <div class="text-center p-8 rounded-2xl bg-green-50 border border-green-100">
                <div class="text-5xl mb-4">📊</div>
                <h3 class="text-xl font-bold text-gray-800 mb-2">Suivi des notes</h3>
                <p class="text-gray-500">Consultez vos résultats et suivez votre progression au fil du temps.</p>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="bg-gray-900 text-gray-400 text-center py-6 text-sm">
        Mini LMS — Développé avec ❤️ en Laravel
    </footer>

</body>
</html>