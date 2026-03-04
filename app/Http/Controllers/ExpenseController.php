<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ExpenseController extends Controller
{   
    public function index()
    {
        $expenses = auth()
            ->user()
            ->expenses()
            ->latest()
            ->get();

        return view('expenses.index', compact('expenses'));
    }

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Request $request)
    {
        $request->merge([
            'currency' => strtoupper($request->currency)
        ]);

        $request->validate([
            'value' => ['required', 'numeric', 'min:0.01'],
            'currency' => ['required', 'string', 'size:3'],
        ]);

        try {
            $response = Http::timeout(5)->get(
                'https://api.exchangerate.host/convert',
                [
                    'from' => $request->currency,
                    'to' => 'BRL',
                    'amount' => 1
                ]
            );

            if (!$response->ok() || !isset($response->json()['result'])) {
                throw new \Exception();
            }

            $price = $response->json()['result'];

            $valorOriginal = $request->valor;
            $valorBrl = bcmul($valorOriginal, $price, 2);

            auth()->user()->expenses()->create([
                'original_value' => $valorOriginal,
                'currency' => $request->currency,
                'price' => $price,
                'brl_value' => $valorBrl,
                'status' => 'completed'
            ]);

        } catch (\Exception $e) {
            auth()->user()->expenses()->create([
                'original_value' => $request->valor,
                'currency' => $request->currency,
                'price' => 0,
                'brl_value' => 0,
                'status' => 'pending'
            ]);
        }

        return back();
    }
}