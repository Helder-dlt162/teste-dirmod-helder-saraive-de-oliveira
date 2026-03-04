<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    <div class="grid md:grid-cols-3 gap-6 mb-8">
                        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                            <p class="text-sm text-gray-500">Total BRL</p>
                            <p class="text-2xl font-bold">
                                R$ {{ number_format($totalBrl, 2, ',', '.') }}
                            </p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                            <p class="text-sm text-gray-500">Total Expenses</p>
                            <p class="text-2xl font-bold">
                                {{ $totalCount }}
                            </p>
                        </div>

                        <div class="bg-white dark:bg-gray-800 p-6 rounded shadow">
                            <p class="text-sm text-gray-500">Pending</p>
                            <p class="text-2xl font-bold text-yellow-500">
                                {{ $pendingCount }}
                            </p>
                        </div>

                    </div>

                    <div class="p-6 rounded shadow">
                        <h3 class="font-semibold mb-4">Latest Expenses</h3>

                        <table class="w-full text-sm">
                            <thead class="border-b">
                                <tr class="text-left">
                                    <th>Name</th>
                                    <th>BRL</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($latest as $expense)
                                <tr class="border-b">
                                    <td>{{ $expense->name }}</td>
                                    <td>R$ {{ number_format($expense->brl_value, 2, ',', '.') }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
