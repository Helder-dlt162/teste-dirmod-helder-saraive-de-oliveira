<x-guest-layout>
<form method="POST" action="{{ route('register') }}"
x-data="{
    step: 1,
    name: '', email: '', cpf: '',
    cep: '', rua: '', bairro: '', cidade: '', estado: '',
    password: '', password_confirmation: '',

    nextStep1() {
        if (!this.name || !this.email || !this.cpf) {
            alert('Preencha nome, email e CPF.');
            return;
        }
        this.step = 2;
    },

    nextStep2() {
        if (!this.cep) {
            alert('Informe o CEP.');
            return;
        }
        this.step = 3;
    },

    submitForm() {
        if (!this.password || !this.password_confirmation) {
            alert('Preencha a senha.');
            return;
        }
        if (this.password !== this.password_confirmation) {
            alert('Senhas não conferem.');
            return;
        }
        $el.submit();
    }
}">
@csrf

<!-- ETAPA 1 -->
<div x-show="step === 1">

    <div>
        <x-input-label value="Nome" />
        <x-text-input class="block mt-1 w-full" name="name" x-model="name" />
    </div>

    <div class="mt-4">
        <x-input-label value="Email" />
        <x-text-input type="email" class="block mt-1 w-full" name="email" x-model="email" />
    </div>

    <div class="mt-4">
        <x-input-label value="CPF" />
        <x-text-input class="block mt-1 w-full" name="cpf" x-model="cpf" />
    </div>

    <div class="mt-4 text-right">
        <x-primary-button type="button" @click="nextStep1()">Próximo</x-primary-button>
    </div>
</div>

<!-- ETAPA 2 -->
<div x-show="step === 2">

    <div>
        <x-input-label value="CEP" />
        <x-text-input class="block mt-1 w-full" name="cep" x-model="cep" />
    </div>

    <div class="mt-4">
        <x-input-label value="Rua" />
        <x-text-input class="block mt-1 w-full" name="rua" x-model="rua" />
    </div>

    <div class="mt-4">
        <x-input-label value="Bairro" />
        <x-text-input class="block mt-1 w-full" name="bairro" x-model="bairro" />
    </div>

    <div class="mt-4">
        <x-input-label value="Cidade" />
        <x-text-input class="block mt-1 w-full" name="cidade" x-model="cidade" />
    </div>

    <div class="mt-4">
        <x-input-label value="Estado" />
        <x-text-input class="block mt-1 w-full" name="estado" x-model="estado" />
    </div>

    <div class="mt-4 flex justify-between">
        <x-primary-button type="button" @click="step = 1">Voltar</x-primary-button>
        <x-primary-button type="button" @click="nextStep2()">Próximo</x-primary-button>
    </div>
</div>

<!-- ETAPA 3 -->
<div x-show="step === 3">

    <div>
        <x-input-label value="Senha" />
        <x-text-input type="password" class="block mt-1 w-full" name="password" x-model="password" />
    </div>

    <div class="mt-4">
        <x-input-label value="Confirmar Senha" />
        <x-text-input type="password" class="block mt-1 w-full" name="password_confirmation" x-model="password_confirmation" />
    </div>

    <div class="mt-4 flex justify-between">
        <x-primary-button type="button" @click="step = 2">Voltar</x-primary-button>
        <x-primary-button type="button" @click="submitForm()">Registrar</x-primary-button>
    </div>
</div>

</form>
</x-guest-layout>