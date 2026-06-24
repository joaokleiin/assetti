<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans text-slate-900 antialiased bg-gradient-to-b from-sky-50 via-slate-50 to-slate-100">
        <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-slate-100">
            <div class="w-full max-w-[1000px] h-[650px] rounded-3xl shadow-2xl overflow-hidden border border-slate-200 bg-white flex flex-col md:flex-row">
                <!-- Left column (visual) -->
                <div class="w-full md:w-1/2 bg-gradient-to-br from-[#0f172a] to-[#1e3a8a] text-white p-8 flex flex-col justify-between">
                    <div>
                        <div class="text-3xl font-extrabold tracking-tight">Asset<span class="text-sky-300">TI</span></div>
                        <h2 class="mt-6 text-2xl font-semibold">Sistema de Gestão de Ativos de TI</h2>
                        <p class="mt-4 text-sm text-sky-100/90">Gerencie equipamentos, categorias, setores e manutenções em um único ambiente.</p>
                    </div>

                    <div class="mt-6">
                        @if(request()->routeIs('login'))
                            <a href="{{ route('register') }}" class="inline-block px-6 py-3 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition">Criar conta</a>
                        @elseif(request()->routeIs('register'))
                            <a href="{{ route('login') }}" class="inline-block px-6 py-3 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition">Entrar</a>
                        @else
                            <a href="{{ route('login') }}" class="inline-block px-6 py-3 rounded-xl bg-white/10 border border-white/20 hover:bg-white/20 transition">Entrar</a>
                        @endif
                    </div>
                </div>

                <!-- Right column (form) -->
                <div class="w-full md:w-1/2 bg-white p-8 flex items-center justify-center">
                    <div class="w-full max-w-md">
                        {{ $slot }}

                        <div class="mt-6 text-center text-sm">
                            <a href="{{ route('public.home') }}" class="text-slate-600 hover:text-slate-900">Voltar para a Home Pública</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
