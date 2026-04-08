<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-6">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="/" class="text-3xl font-extrabold text-blue-700">🎓 Mini LMS</a>
                <p class="text-gray-500 text-sm mt-1">Plateforme pédagogique</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Connexion</h2>
                    <p class="text-gray-400 text-sm mt-1">Bienvenue, entrez vos identifiants</p>
                </div>

                <x-auth-session-status class="mb-4 text-center text-green-600" :status="session('status')" />

                <form method="POST" action="{{ route('login') }}">
                    @csrf

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <div class="mb-4">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <div class="flex items-center justify-between mb-6">
                        <label class="flex items-center text-sm text-gray-500">
                            <input type="checkbox" name="remember" class="rounded border-gray-300 text-blue-600 mr-2">
                            Se souvenir de moi
                        </label>
                        @if (Route::has('password.request'))
                            <a href="{{ route('password.request') }}" class="text-sm text-blue-600 hover:underline">
                                Mot de passe oublié ?
                            </a>
                        @endif
                    </div>

                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md">
                        Se connecter →
                    </button>

                    @if (Route::has('register'))
                        <p class="mt-5 text-center text-sm text-gray-500">
                            Pas encore de compte ?
                            <a href="{{ route('register') }}" class="text-blue-600 hover:underline font-medium">
                                Créer un compte
                            </a>
                        </p>
                    @endif

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>