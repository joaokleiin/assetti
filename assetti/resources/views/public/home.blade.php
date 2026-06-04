@php
    $year = date('Y');
@endphp

@extends('layouts.public')

@section('content')
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-5 gap-6">
                <a href="{{ route('public.home') }}" class="flex items-center gap-3">
                    <div class="flex h-11 w-11 items-center justify-center rounded-2xl bg-slate-900 text-white font-bold">AT</div>
                    <div>
                        <p class="text-lg font-semibold text-slate-900">AssetTI</p>
                    </div>
                </a>
                <nav class="hidden md:flex items-center gap-8 text-sm font-medium text-slate-700">
                    <a href="{{ route('public.home') }}" class="hover:text-slate-900">Início</a>
                </nav>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-50">Login</a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1">
        <section class="bg-slate-950 text-white">
            <div class="max-w-7xl mx-auto px-4 py-20 sm:px-6 lg:px-8">
                <div class="grid gap-12 lg:grid-cols-2 lg:items-center">
                    <div class="space-y-8">
                        <div class="space-y-4 max-w-2xl">
                            <p class="text-sm uppercase tracking-[0.3em] text-sky-400">Solução corporativa</p>
                            <h1 class="text-4xl font-semibold tracking-tight sm:text-5xl">AssetTI</h1>
                            <p class="text-lg leading-8 text-slate-300">Sistema de Gestão Patrimonial de TI</p>
                            <p class="text-base leading-8 text-slate-400">Sistema desenvolvido para gerenciamento de equipamentos, setores, categorias, marcas e histórico de manutenções.</p>
                        </div>

                        <div class="flex flex-col gap-3 sm:flex-row">
                            <a href="#equipamentos" class="inline-flex items-center justify-center rounded-full bg-sky-500 px-6 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-sky-400">Ver Equipamentos</a>
                            <a href="{{ route('login') }}" class="inline-flex items-center justify-center rounded-full border border-white/20 bg-white/10 px-6 py-3 text-sm font-semibold text-white transition hover:border-white hover:bg-white/20">Acessar Sistema</a>
                        </div>
                    </div>

                    <div class="rounded-[2rem] border border-white/10 bg-white/5 p-8 shadow-2xl backdrop-blur-xl">
                        <div class="rounded-3xl border border-white/10 bg-slate-900/80 p-8 text-slate-100">
                            <p class="text-sm uppercase tracking-[0.35em] text-sky-400">Visão geral</p>
                            <h2 class="mt-4 text-2xl font-semibold">Controle completo para seu parque de TI</h2>
                            <p class="mt-3 text-sm leading-6 text-slate-400">Confira as principais informações do sistema com dados reais do banco.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section id="equipamentos" class="bg-slate-50 py-16">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid gap-6 sm:grid-cols-2 xl:grid-cols-4">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total de Equipamentos</p>
                                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $totalEquipments }}</p>
                            </div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M3 7h18M3 12h18M3 17h18" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total de Categorias</p>
                                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $totalCategories }}</p>
                            </div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 2l3 6 6 .5-5 4.5 2 6-5-3.5L7 19l2-6-5-4.5 6-.5z" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total de Setores</p>
                                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $totalSectors }}</p>
                            </div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M4 6h16M4 12h16M4 18h8" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Total de Manutenções</p>
                                <p class="mt-4 text-3xl font-semibold text-slate-900">{{ $totalMaintenances }}</p>
                            </div>
                            <div class="flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"><path d="M12 5v14M5 12h14" stroke-linecap="round" stroke-linejoin="round"/></svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <footer class="border-t border-slate-200 bg-white py-6">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 text-center text-sm text-slate-500">
            AssetTI © {{ $year }}
        </div>
    </footer>
@endsection
