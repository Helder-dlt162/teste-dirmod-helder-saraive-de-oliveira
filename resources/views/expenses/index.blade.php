<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Expenses
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">

        {{-- FORM --}}
        <form method="POST" action="{{ route('expenses.store') }}" class="flex gap-2">
            @csrf

            <input type="number" name="valor" step="0.01" required class="border rounded px-3 py-2">

            <select name="moeda" required class="border rounded px-3 py-2">
                <option value="USD">USD</option>
                <option value="EUR">EUR</option>
            </select>

            <button class="bg-indigo-600 text-white px-4 py-2 rounded">
                Salvar
            </button>
        </form>

        {{-- LISTA --}}
        <div class="bg-white shadow rounded p-4">
            <table class="w-full">
                <thead>
                    <tr class="text-left border-b">
                        <th>Valor</th>
                        <th>Moeda</th>
                        <th>BRL</th>
                        <th>Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($expenses as $expense)
                        <tr class="border-b">
                            <td>{{ $expense->valor_original }}</td>
                            <td>{{ $expense->moeda }}</td>
                            <td>R$ {{ $expense->valor_brl }}</td>
                            <td>{{ $expense->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>