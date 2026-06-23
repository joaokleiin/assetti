<x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="space-y-6">
        @csrf

        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="mt-2" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <x-input-label for="password" :value="__('Senha')" />
            <x-text-input id="password" class="mt-2" type="password" name="password" required autocomplete="current-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between">
            <label for="remember_me" class="inline-flex items-center">
                <input id="remember_me" type="checkbox" class="h-4 w-4 rounded border-slate-300 text-sky-600 focus:ring-sky-400" name="remember">
                <span class="ml-2 text-sm text-slate-600">{{ __('Lembrar-me') }}</span>
            </label>

            <div class="text-sm">
                @if (Route::has('password.request'))
                    <a class="font-medium text-sky-500 hover:text-sky-400" href="{{ route('password.request') }}">{{ __('Esqueceu sua senha?') }}</a>
                @endif
            </div>
        </div>

        <div>
            <x-primary-button>
                {{ __('Entrar') }}
            </x-primary-button>
        </div>

        <div class="pt-4 text-center text-sm text-slate-600">
            @if (Route::has('register'))
                <a href="{{ route('register') }}" class="text-sky-500 hover:text-sky-400">Criar conta</a>
            @endif
        </div>
    </form>
</x-guest-layout>
