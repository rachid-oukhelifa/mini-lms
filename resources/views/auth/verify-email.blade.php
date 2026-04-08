<x-guest-layout>
    <div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-blue-50 to-indigo-100 px-6">

        <div class="w-full max-w-md">

            <!-- Logo -->
            <div class="text-center mb-8">
                <a href="{{ route('login') }}" class="text-3xl font-extrabold text-blue-700">🎓 Mini LMS</a>
                <p class="text-gray-500 text-sm mt-1">Vérification de votre compte</p>
            </div>

            <div class="bg-white rounded-2xl shadow-lg border border-gray-100 p-8">

                <!-- Title -->
                <div class="mb-6">
                    <h2 class="text-2xl font-bold text-gray-900">Vérifiez votre email</h2>
                    <p class="text-gray-400 text-sm mt-1">Un dernier pas avant de commencer 🚀</p>
                </div>

                <!-- Message -->
                <div class="mb-4 text-sm text-gray-600 leading-relaxed">
                    Merci pour votre inscription 🙌 <br><br>
                    Avant de commencer, veuillez vérifier votre adresse email en cliquant sur le lien que nous venons de vous envoyer.
                    <br><br>
                    Si vous n’avez pas reçu l’email, vous pouvez en demander un nouveau ci-dessous.
                </div>

                <!-- Success -->
                @if (session('status') == 'verification-link-sent')
                    <div class="mb-4 text-sm text-green-600 text-center bg-green-50 border border-green-200 rounded-lg p-3">
                        ✅ Un nouveau lien de vérification a été envoyé !
                    </div>
                @endif

                <!-- Actions -->
                <div class="mt-6 space-y-4">

                    <!-- Resend -->
                    <form method="POST" action="{{ route('verification.send') }}">
                        @csrf
                        <button type="submit"
                            class="w-full bg-blue-600 hover:bg-blue-700 text-white font-semibold py-3 rounded-xl transition shadow-md">
                            Renvoyer l’email →
                        </button>
                    </form>

                    <!-- Logout -->
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="w-full text-sm text-gray-500 hover:text-gray-700 underline text-center">
                            Se déconnecter
                        </button>
                    </form>

                </div>

            </div>
        </div>
    </div>
</x-guest-layout>