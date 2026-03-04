<x-guest-layout>
    <form method="POST" action="{{ route('expenses.store') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="valor" :value="__('Valor')" />
            <x-text-input
                id="valor"
                name="valor"
                type="number"
                step="0.01"
                class="block mt-1 w-full"
                :value="old('valor')"
                required
                autofocus
            />
            <x-input-error :messages="$errors->get('valor')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="moeda" :value="__('Moeda')" />
            <select
                id="moeda"
                name="moeda"
                class="border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm block mt-1 w-full"
                required
            >
                <option value="">Selecione</option>
                <option value="USD" @selected(old('moeda') == 'USD')>USD</option>
                <option value="EUR" @selected(old('moeda') == 'EUR')>EUR</option>
                <option value="GBP" @selected(old('moeda') == 'GBP')>GBP</option>
            </select>
            <x-input-error :messages="$errors->get('moeda')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end">
            <x-primary-button>
                {{ __('Salvar despesa') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>