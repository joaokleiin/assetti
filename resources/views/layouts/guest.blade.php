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
        <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8">
            <div class="w-full max-w-5xl">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                    <div class="hidden lg:flex items-center justify-center">
                        <div class="max-w-md rounded-2xl bg-gradient-to-br from-sky-700 to-slate-900 p-8 text-white shadow-2xl transform -rotate-1">
                            <div class="flex items-center gap-3">
                                <div class="text-3xl font-extrabold tracking-tight">Asset<span class="text-sky-200">TI</span></div>
                            </div>
                            <h2 class="mt-4 text-2xl font-semibold">Sistema de Gestão de Ativos de TI</h2>
                            <p class="mt-4 text-sm text-sky-100/90">Gerencie equipamentos, categorias, setores e histórico de manutenções com segurança.</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-center lg:col-start-2">
                        <div class="w-full max-w-md sm:max-w-lg mx-4">
                            <div class="bg-white border border-slate-200 rounded-2xl shadow-xl p-8 transition-transform hover:scale-[1.01]">
                                <div class="mb-6 text-center">
                                    <a href="{{ route('public.home') }}" class="inline-flex items-center justify-center">
                                        <div class="text-2xl font-bold text-slate-900">Asset<span class="text-sky-500">TI</span></div>
                                    </a>
                                    <h3 class="mt-3 text-lg font-semibold text-slate-900">Sistema de Gestão de Ativos de TI</h3>
                                    <p class="mt-1 text-sm text-slate-500">Acesse sua conta para continuar</p>
                                </div>

                                {{ $slot }}

                                <div class="mt-6 text-center text-sm">
                                    <a href="{{ route('public.home') }}" class="text-slate-600 hover:text-slate-900">Voltar para a Home Pública</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
