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
    <body class="font-sans text-slate-900 antialiased bg-slate-50">
        <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 bg-gradient-to-b from-slate-50 to-slate-100">
            <div class="w-full max-w-5xl">
                <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 items-center">
                    <div class="hidden lg:flex items-center justify-center">
                        <div class="max-w-md rounded-3xl bg-slate-950/90 p-10 text-white shadow-2xl">
                            <img src="{{ asset('images/logo-at.jpeg') }}" alt="AssetTI Logo" class="h-14 w-auto object-contain mb-6" />
                            <h2 class="text-2xl font-semibold">AssetTI</h2>
                            <p class="mt-3 text-slate-200">Sistema de Gestão Patrimonial de TI</p>
                            <p class="mt-6 text-sm text-slate-400">Acesse sua conta para gerenciar equipamentos, categorias, setores e histórico de manutenções.</p>
                        </div>
                    </div>

                    <div class="flex items-center justify-center lg:col-start-2">
                        <div class="w-full max-w-md sm:max-w-lg mx-4">
                            <div class="bg-white border border-slate-200 rounded-3xl shadow-sm p-6">
                                <div class="mb-6 text-center">
                                    <a href="{{ route('public.home') }}" class="inline-flex items-center justify-center">
                                        <img src="{{ asset('images/logo-at.jpeg') }}" alt="AssetTI Logo" class="mx-auto h-10 w-auto object-contain" />
                                    </a>
                                    <h3 class="mt-4 text-lg font-semibold text-slate-900">Entrar na sua conta</h3>
                                    <p class="mt-1 text-sm text-slate-500">Sistema de Gestão Patrimonial de TI</p>
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
