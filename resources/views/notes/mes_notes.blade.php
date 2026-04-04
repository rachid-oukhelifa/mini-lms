<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">Mes notes</h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">

                <table class="w-full text-left border-collapse">
                    <thead>
                        <tr class="border-b">
                            <th class="py-2">Matière</th>
                            <th class="py-2">Note</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notes as $note)
                        <tr class="border-b hover:bg-gray-50">
                            <td class="py-2">{{ $note->matiere }}</td>
                            <td class="py-2 font-semibold {{ $note->note >= 10 ? 'text-green-600' : 'text-red-600' }}">
                                {{ $note->note }}/20
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="2" class="py-4 text-center text-gray-500">Aucune note pour l'instant.</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</x-app-layout>