<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-6">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ route('login') }}" class="text-3xl font-extrabold text-blue-700">🎓 Mini LMS</a>
                <p class="text-gray-500 text-sm mt-1">Récupération du mot de passe</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                <!-- Title -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Mot de passe oublié ?</h2>
                    <p class="text-gray-400 text-sm mt-1">On va t’aider à le récupérer 🔐</p>
                </div>

                <!-- Info -->
                <div class="mb-4 text-sm text-gray-600 leading-relaxed">
                    Pas de souci 👍  
                    Entre ton adresse email et on t’enverra un lien pour réinitialiser ton mot de passe.
                </div>

                <!-- Status -->
                <x-auth-session-status class="mb-4 text-center text-green-600" :status="session('status')" />

                <form method="POST" action="{{ route('password.email') }}">
                    @csrf

                    <!-- Email -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Email</label>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <x-input-error :messages="$errors->get('email')" class="mt-1" />
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md">
                        Envoyer le lien →
                    </button>

                    <!-- Back to login -->
                    <p class="mt-5 text-center text-sm text-gray-500">
                        Tu te souviens de ton mot de passe ?
                        <a href="{{ route('login') }}" class="text-blue-600 hover:underline font-medium">
                            Se connecter
                        </a>
                    </p>

                </form>
            </div>
        </div>
    </div>
</x-guest-layout>