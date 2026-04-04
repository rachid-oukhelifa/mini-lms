<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Modifier la note</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <form action="{{ route('notes.update', $note) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Apprenant</label>
                        <select name="user_id" class="w-full border rounded px-3 py-2">
                            <option value="">-- Choisir un apprenant --</option>
                            @foreach($apprenants as $apprenant)
                                <option value="{{ $apprenant->id }}" {{ old('user_id', $note->user_id) == $apprenant->id ? 'selected' : '' }}>
                                    {{ $apprenant->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Matière</label>
                        <input type="text" name="matiere" value="{{ old('matiere', $note->matiere) }}"
                            class="w-full border rounded px-3 py-2 @error('matiere') border-red-500 @enderror">
                        @error('matiere')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="mb-4">
                        <label class="block text-gray-700 mb-1">Note /20</label>
                        <input type="number" step="0.5" min="0" max="20" name="note" value="{{ old('note', $note->note) }}"
                            class="w-full border rounded px-3 py-2 @error('note') border-red-500 @enderror">
                        @error('note')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex gap-2">
                        <button type="submit" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Modifier</button>
                        <a href="{{ route('notes.index') }}" class="bg-gray-300 text-gray-700 px-4 py-2 rounded hover:bg-gray-400">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>