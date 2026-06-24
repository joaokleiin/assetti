<x-guest-layout>
    <div class="text-center mb-6">
        <h3 class="text-2xl font-semibold text-slate-900">Criar sua conta</h3>
        <p class="mt-1 text-sm text-slate-500">Cadastre-se para começar a gerenciar seus ativos</p>
    </div>

    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Nome</label>
            <div class="relative mt-2">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <!-- User Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8z" />
                        <path d="M2 18a8 8 0 0116 0H2z" />
                    </svg>
                </div>
                <x-text-input id="name" class="h-12 pl-12" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">E-mail</label>
            <div class="relative mt-2">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <!-- Mail Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.94 6.34A2 2 0 014 6h12a2 2 0 011.06.34L10 11 2.94 6.34z" />
                        <path d="M18 8.12V14a2 2 0 01-2 2H4a2 2 0 01-2-2V8.12l7.44 4.47a2 2 0 002.12 0L18 8.12z" />
                    </svg>
                </div>
                <x-text-input id="email" class="h-12 pl-12" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700">Senha</label>
            <div class="relative mt-2">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <!-- Lock Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 8V6a5 5 0 1110 0v2h1a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6a2 2 0 012-2h1zm2-2a3 3 0 116 0v2H7V6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input id="password" class="h-12 pl-12" type="password" name="password" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirmar senha</label>
            <div class="relative mt-2">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <!-- Lock Closed Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 8V6a5 5 0 1110 0v2h1a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6a2 2 0 012-2h1zm2-2a3 3 0 116 0v2H7V6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="h-12 pl-12" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-2">
            <a class="text-sm text-slate-600 hover:text-slate-900 transition" href="{{ route('login') }}">Entrar</a>

            <button type="submit" class="w-full bg-sky-500 hover:bg-sky-600 text-white rounded-xl h-12 shadow-sm font-semibold transition ms-4">Criar conta</button>
        </div>
    </form>
</x-guest-layout>
