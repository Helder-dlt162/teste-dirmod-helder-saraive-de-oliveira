<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use App\Rules\CpfValid;
use Illuminate\Support\Facades\Http;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'cpf' => preg_replace('/\D/', '', $request->cpf),
            'cep' => preg_replace('/\D/', '', $request->cep),
        ]);

        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:users,email'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'cpf' => ['required', 'string', 'unique:users,cpf', new CpfValid],
            'cep' => ['required', 'digits:8'],
        ]);

        try {
            $response = Http::timeout(5)
                ->get("https://viacep.com.br/ws/{$request->cep}/json/");

            if (!$response->ok() || $response->json('erro')) {
                return back()
                    ->withErrors(['cep' => 'CEP inválido ou inexistente.'])
                    ->withInput();
            }

            $data = $response->json();

        } catch (\Exception $e) {
            return back()
                ->withErrors(['cep' => 'Erro ao consultar o CEP. Tente novamente.'])
                ->withInput();
        }

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'cpf' => $request->cpf,
            'cep' => $request->cep,
            'rua' => $data['logradouro'] ?? null,
            'bairro' => $data['bairro'] ?? null,
            'cidade' => $data['localidade'] ?? null,
            'estado' => $data['uf'] ?? null,
        ]);

        event(new Registered($user));
        Auth::login($user);

        return redirect()->route('dashboard');
    }
}
