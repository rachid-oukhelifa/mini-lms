<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-6">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ route('login') }}" class="text-3xl font-extrabold text-blue-700">🎓 Mini LMS</a>
                <p class="text-gray-500 text-sm mt-1">Zone sécurisée</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                <!-- Title -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Confirmation requise</h2>
                    <p class="text-gray-400 text-sm mt-1">Veuillez confirmer votre mot de passe pour continuer</p>
                </div>

                <!-- Message -->
                <div class="mb-4 text-sm text-gray-600 leading-relaxed">
                    Cette zone de l’application est sécurisée.  
                    Merci de confirmer votre mot de passe avant de continuer.
                </div>

                <form method="POST" action="{{ route('password.confirm') }}">
                    @csrf

                    <!-- Password -->
                    <div class="mb-6">
                        <label class="block text-sm font-medium text-gray-700 mb-1">Mot de passe</label>
                        <input type="password" name="password" required
                            class="w-full px-4 py-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent transition">
                        <x-input-error :messages="$errors->get('password')" class="mt-1" />
                    </div>

                    <!-- Button -->
                    <button type="submit"
                        class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md">
                        Confirmer →
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-guest-layout>