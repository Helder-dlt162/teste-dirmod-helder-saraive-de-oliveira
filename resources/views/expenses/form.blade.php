<div>
    <form method="POST" action="{{ route('expenses.store') }}" class="flex gap-2">
        @csrf

        <input
            type="number"
            step="0.01"
            name="value"
            required
            class="border rounded px-3 py-2"
            placeholder="Value"
        >

        <select name="currency" required class="border rounded px-3 py-2">
            <option value="USD">USD</option>
            <option value="EUR">EUR</option>
            <option value="GBP">GBP</option>
        </select>

        <button class="bg-indigo-600 text-white px-4 py-2 rounded">
            Save
        </button>
    </form>
</div>