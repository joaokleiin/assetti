@php
    $year = date('Y');
@endphp

@extends('layouts.public')

@section('content')
    {{-- Header Navigation --}}
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-5 gap-6">
                <a href="{{ route('public.home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/logo-at.jpeg') }}" alt="AssetTI Logo" class="h-10 w-auto max-w-[160px] object-contain sm:h-11" />
                    <div>
                        <p class="text-lg font-semibold text-slate-900">AssetTI</p>
                    </div>
                </a>
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-700">
                    <a href="{{ route('public.home') }}" class="hover:text-slate-900">Início</a>
                    <a href="{{ route('public.equipments.index') }}" class="hover:text-slate-900">Catálogo</a>
                </nav>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-50">Login</a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        {{-- Hero Section --}}
        <section class="bg-slate-950 text-white">
            <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div class="space-y-8">
                        <div class="space-y-4 max-w-2xl">
                            <p class="text-sm uppercase tracking-[0.3em] text-sky-400">Solução corporativa</p>
                            <h1 class="text-4xl font-semibold tracking-tight sm:text-5xl">AssetTI</h1>
                            <p class="text-lg leading-8 text-slate-300">Gestão patrimonial de TI para ativos, setores, categorias e manutenções.</p>
                            <p class="text-base leading-8 text-slate-400">Uma área pública com informações estratégicas e consulta de equipamentos em tempo real.</p>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="#equipamentos" class="inline-flex items-center justify-center rounded-full bg-sky-500 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-400">Ver Equipamentos</a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/10 px-6 py-3 text-sm font-semibold text-white transition hover:border-white hover:bg-white/20">Acessar Sistema</a>
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-8 shadow-2xl backdrop-blur-xl">
                        <div class="rounded-3xl border border-white/10 bg-slate-900/80 p-8 text-slate-100">
                            <p class="text-sm uppercase tracking-[0.35em] text-sky-400">Visão geral</p>
                            <h2 class="mt-4 text-2xl font-semibold">Controle sólido para o parque de TI</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-400">Acompanhe equipamentos, categorias, setores e manutenções com um painel público leve e profissional.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        {{-- Statistics Section --}}
        <section class="bg-slate-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                    @include('public.components.stat-card', [
                        'title' => 'Total de Equipamentos',
                        'value' => $totalEquipments,
                        'bgClass' => 'bg-sky-100',
                        'textClass' => 'text-sky-700',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7h18M3 12h18M3 17h18" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    ])
                    @include('public.components.stat-card', [
                        'title' => 'Total de Categorias',
                        'value' => $totalCategories,
                        'bgClass' => 'bg-emerald-100',
                        'textClass' => 'text-emerald-700',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3 6 6 .5-5 4.5 2 6-5-3.5L7 19l2-6-5-4.5 6-.5z" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    ])
                    @include('public.components.stat-card', [
                        'title' => 'Total de Setores',
                        'value' => $totalSectors,
                        'bgClass' => 'bg-amber-100',
                        'textClass' => 'text-amber-700',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    ])
                    @include('public.components.stat-card', [
                        'title' => 'Total de Manutenções',
                        'value' => $totalMaintenances,
                        'bgClass' => 'bg-cyan-100',
                        'textClass' => 'text-cyan-700',
                        'icon' => '<svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round"/></svg>',
                    ])
                </div>
            </div>
        </section>

        {{-- Recent Equipments Section --}}
        <section id="equipamentos" class="bg-slate-50 pb-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
                <div class="flex flex-col gap-3 sm:flex-row sm:items-end sm:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Consulta pública</p>
                        <h2 class="mt-2 text-3xl font-semibold text-slate-900">Tecnologias e Equipamentos Recentes</h2>
                        <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">Acompanhe os 6 equipamentos mais recentes do inventário, com status e detalhes públicos para consulta rápida.</p>
                    </div>
                    <a href="{{ route('public.equipments.index') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Ir para catálogo</a>
                </div>

                <div class="grid gap-6 md:grid-cols-2 xl:grid-cols-3">
                    @forelse ($recentEquipments as $equipment)
                        @include('public.components.recent-equipment-card', ['equipment' => $equipment])
                    @empty
                        <div class="rounded-3xl border border-slate-200 bg-white p-10 text-center text-slate-500 shadow-sm md:col-span-2 xl:col-span-3">
                            Nenhum equipamento cadastrado no momento.
                        </div>
                    @endforelse
                </div>
            </div>
        </section>

        {{-- Recent Maintenances Section --}}
        <section class="bg-slate-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="space-y-8">
                    <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                        <div>
                            <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Histórico recente</p>
                            <h2 class="mt-2 text-3xl font-semibold text-slate-900">Últimas Manutenções Registradas</h2>
                            <p class="mt-3 max-w-2xl text-sm leading-6 text-slate-600">Veja os 5 registros mais recentes de atendimento técnico vinculados aos equipamentos do AssetTI.</p>
                        </div>
                        <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-semibold text-slate-700">{{ $recentMaintenances->count() }} registros</span>
                    </div>

                    <div class="grid gap-4">
                        @forelse ($recentMaintenances as $maintenance)
                            @include('public.components.recent-maintenance-item', ['maintenance' => $maintenance])
                        @empty
                            <div class="rounded-3xl border border-slate-200 bg-white p-10 text-center text-slate-500 shadow-sm">
                                Nenhuma manutenção recente disponível.
                            </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </section>
    </main>

    {{-- Footer --}}
    <footer class="border-t border-slate-200 bg-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-500">
            AssetTI © {{ $year }}
        </div>
    </footer>
@endsection
