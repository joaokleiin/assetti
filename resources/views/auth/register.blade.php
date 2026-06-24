<x-guest-layout>
    <form method="POST" action="{{ route('register') }}" class="space-y-6">
        @csrf

        <div>
            <label for="name" class="block text-sm font-medium text-slate-700">Nome</label>
            <div class="relative mt-2">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <!-- User Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M10 10a4 4 0 100-8 4 4 0 000 8z" />
                        <path d="M2 18a8 8 0 0116 0H2z" />
                    </svg>
                </div>
                <x-text-input id="name" class="mt-0 pl-10" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

        <div>
            <label for="email" class="block text-sm font-medium text-slate-700">E-mail</label>
            <div class="relative mt-2">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <!-- Mail Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path d="M2.94 6.34A2 2 0 014 6h12a2 2 0 011.06.34L10 11 2.94 6.34z" />
                        <path d="M18 8.12V14a2 2 0 01-2 2H4a2 2 0 01-2-2V8.12l7.44 4.47a2 2 0 002.12 0L18 8.12z" />
                    </svg>
                </div>
                <x-text-input id="email" class="mt-0 pl-10" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div>
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <div>
            <label for="password" class="block text-sm font-medium text-slate-700">Senha</label>
            <div class="relative mt-2">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <!-- Lock Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 8V6a5 5 0 1110 0v2h1a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6a2 2 0 012-2h1zm2-2a3 3 0 116 0v2H7V6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input id="password" class="mt-0 pl-10" type="password" name="password" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div>
            <label for="password_confirmation" class="block text-sm font-medium text-slate-700">Confirmar senha</label>
            <div class="relative mt-2">
                <div class="pointer-events-none absolute inset-y-0 left-0 pl-3 flex items-center text-slate-400">
                    <!-- Lock Closed Icon -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" viewBox="0 0 20 20" fill="currentColor">
                        <path fill-rule="evenodd" d="M5 8V6a5 5 0 1110 0v2h1a2 2 0 012 2v6a2 2 0 01-2 2H4a2 2 0 01-2-2v-6a2 2 0 012-2h1zm2-2a3 3 0 116 0v2H7V6z" clip-rule="evenodd" />
                    </svg>
                </div>
                <x-text-input id="password_confirmation" class="mt-0 pl-10" type="password" name="password_confirmation" required autocomplete="new-password" />
            </div>
            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-between mt-4">
            <a class="text-sm text-slate-600 hover:text-slate-900 transition" href="{{ route('login') }}">Voltar ao login</a>

            <x-primary-button class="ms-4">
                Criar conta
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
