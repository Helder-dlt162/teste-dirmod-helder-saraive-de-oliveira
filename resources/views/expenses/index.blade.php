<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">
            Expenses
        </h2>
    </x-slot>

    <div class="p-6 space-y-6">
        @include('expenses.form')
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
                            <td>{{ $expense->original_value }}</td>
                            <td>{{ $expense->currency }}</td>
                            <td>R$ {{ $expense->brl_value }}</td>
                            <td>{{ $expense->status }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

    </div>
</x-app-layout>