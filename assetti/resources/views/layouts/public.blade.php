<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>AssetTI</title>
        <meta name="description" content="Sistema de Gestão Patrimonial de TI para controle de equipamentos, setores, categorias e manutenções." />

        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="antialiased bg-slate-50 text-slate-900">
        <div class="min-h-screen flex flex-col">
            @yield('content')
        </div>
    </body>
</html>
