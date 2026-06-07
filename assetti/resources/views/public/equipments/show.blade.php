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
                    <a href="{{ route('public.equipments.index') }}" class="text-slate-900">Catálogo</a>
                </nav>
                <div class="flex items-center gap-3">
                    <a href="{{ route('login') }}" class="inline-flex items-center rounded-full border border-slate-200 bg-white px-4 py-2 text-sm font-semibold text-slate-900 shadow-sm transition hover:bg-slate-50">Login</a>
                </div>
            </div>
        </div>
    </header>

    <main class="flex-1 bg-slate-50 py-12">
        <div class="max-w-6xl mx-auto px-4 sm:px-6 lg:px-8 space-y-8">
            <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <nav class="text-sm text-slate-500" aria-label="Breadcrumb">
                            <ol class="flex items-center gap-2">
                                <li><a href="{{ route('public.home') }}" class="hover:text-slate-900">Início</a></li>
                                <li>&gt;</li>
                                <li><a href="{{ route('public.equipments.index') }}" class="hover:text-slate-900">Equipamentos</a></li>
                                <li>&gt;</li>
                                <li class="font-semibold text-slate-900">{{ $equipment->name }}</li>
                            </ol>
                        </nav>
                        <h1 class="mt-4 text-3xl font-semibold text-slate-900">{{ $equipment->name }}</h1>
                        <p class="mt-2 text-sm text-slate-500">Patrimônio {{ $equipment->asset_number }}</p>
                    </div>
                    <a href="{{ route('public.equipments.index') }}" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Voltar para catálogo</a>
                </div>
            </div>

            <div class="grid gap-6 lg:grid-cols-[1.3fr_0.7fr]">
                <div class="space-y-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-slate-900">Informações gerais</h2>
                        <div class="mt-6 grid gap-6 sm:grid-cols-2">
                            <div class="rounded-3xl bg-slate-50 p-5">
                                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Categoria</p>
                                <p class="mt-3 text-base font-semibold text-slate-900">{{ $equipment->category->name }}</p>
                            </div>
                            <div class="rounded-3xl bg-slate-50 p-5">
                                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Marca</p>
                                <p class="mt-3 text-base font-semibold text-slate-900">{{ $equipment->brand->name }}</p>
                            </div>
                            <div class="rounded-3xl bg-slate-50 p-5">
                                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Setor</p>
                                <p class="mt-3 text-base font-semibold text-slate-900">{{ $equipment->sector->name }}</p>
                            </div>
                            <div class="rounded-3xl bg-slate-50 p-5">
                                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Status</p>
                                <div class="mt-3">@include('equipments.status-badge', ['status' => $equipment->status])</div>
                            </div>
                        </div>

                        <div class="mt-8 grid gap-6 sm:grid-cols-2">
                            <div class="rounded-3xl bg-white p-5 shadow-sm">
                                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Número de série</p>
                                <p class="mt-3 text-base font-semibold text-slate-900">{{ $equipment->serial_number ?: '-' }}</p>
                            </div>
                            <div class="rounded-3xl bg-white p-5 shadow-sm">
                                <p class="text-sm uppercase tracking-[0.3em] text-slate-500">Data de aquisição</p>
                                <p class="mt-3 text-base font-semibold text-slate-900">{{ $equipment->acquisition_date?->format('d/m/Y') ?: '-' }}</p>
                            </div>
                        </div>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-slate-900">Descrição</h2>
                        <p class="mt-4 text-sm leading-7 text-slate-600">{{ $equipment->description ?: 'Nenhuma descrição fornecida.' }}</p>
                    </div>
                </div>

                <div class="space-y-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-slate-900">Visão geral</h2>
                        <p class="mt-4 text-sm leading-7 text-slate-600">Acesse o histórico completo de manutenções para este equipamento e acompanhe cada atualização em um formato moderno.</p>
                    </div>
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-lg font-semibold text-slate-900">Observações</h2>
                        <p class="mt-4 text-sm leading-7 text-slate-600">{{ $equipment->notes ?: 'Nenhuma observação registrada.' }}</p>
                    </div>
                </div>
            </div>

            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h2 class="text-lg font-semibold text-slate-900">Histórico de manutenções</h2>
                        <p class="mt-2 text-sm text-slate-500">As últimas manutenções vinculadas a este ativo.</p>
                    </div>
                    <span class="rounded-full bg-slate-100 px-4 py-2 text-sm font-medium text-slate-700">{{ $maintenances->count() }} registros</span>
                </div>

                <div class="mt-6 overflow-x-auto">
                    <table class="min-w-full divide-y divide-slate-200 text-sm">
                        <thead class="bg-slate-50 text-slate-700">
                            <tr>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-[0.2em]">Data</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-[0.2em]">Tipo</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-[0.2em]">Status</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-[0.2em]">Responsável</th>
                                <th class="px-4 py-3 text-left font-semibold uppercase tracking-[0.2em]">Observações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-200 bg-white">
                            @forelse ($maintenances as $maintenance)
                                <tr class="hover:bg-slate-50">
                                    <td class="px-4 py-4 text-slate-700">{{ $maintenance->maintenance_date->format('d/m/Y') }}</td>
                                    <td class="px-4 py-4 font-medium text-slate-900">{{ $maintenance->maintenance_type }}</td>
                                    <td class="px-4 py-4">@include('maintenances.status-badge', ['status' => $maintenance->status])</td>
                                    <td class="px-4 py-4 text-slate-700">{{ $maintenance->user?->name ?: 'Não informado' }}</td>
                                    <td class="px-4 py-4 text-slate-700">{{ \Illuminate\Support\Str::limit($maintenance->notes ?: $maintenance->problem_description, 80) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-4 py-8 text-center text-slate-500">Nenhuma manutenção registrada para este equipamento.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </section>
        </div>
    </main>
@endsection
