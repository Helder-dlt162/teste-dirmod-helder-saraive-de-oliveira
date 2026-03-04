<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Config;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExpenseController extends Controller
{
    public function index()
    {
        $expenses = auth()->user()
            ->expenses()
            ->latest()
            ->get();

        return view('expenses.index', compact('expenses'));
    }

    public function destroy(\App\Models\Expense $expense)
    {
        if ($expense->user_id !== auth()->id()) {
            abort(403);
        }

        $expense->delete();

        return back();
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'value' => ['required', 'numeric', 'min:0.01'],
            'currency' => ['required', 'string', 'size:3'],
        ]);

        try {


        $response = Http::timeout(5)->get(
            "https://api.exchangerate.host/convert",
            [
                'access_key' => Config::get('services.exchange.key'),
                'from' => $request->currency,
                'to' => 'BRL',
                'amount' => 1
            ]
        );

        if (!$response->ok() || !$response->json('success')) {
            throw new \Exception();
        }

        $exchangeRate = $response->json()['result'];

        $originalValue = (float) $request->value;
        $brlValue = $originalValue * $exchangeRate;

        auth()->user()->expenses()->create([
            'name' => $request->name,
            'original_value' => $originalValue,
            'currency' => $request->currency,
            'exchange_rate' => $exchangeRate,
            'brl_value' => $brlValue,
            'status' => 'completed'
        ]);

        } catch (\Exception $e) {

            auth()->user()->expenses()->create([
                'original_value' => $request->value,
                'currency' => $request->currency,
                'exchange_rate' => 0,
                'brl_value' => 0,
                'status' => 'pending'
            ]);

        }

        return redirect()->route('expenses.index');
    }
}