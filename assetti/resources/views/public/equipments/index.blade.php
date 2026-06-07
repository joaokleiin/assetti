@extends('layouts.public')

@section('content')
    <header class="bg-white border-b border-slate-200">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="flex items-center justify-between py-5 gap-6">
                <a href="{{ route('public.home') }}" class="flex items-center gap-3">
                    <img src="{{ asset('images/assetti-logo.png') }}" alt="AssetTI Logo" class="h-10 w-auto max-w-[160px] object-contain sm:h-11" />
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
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 space-y-10">
            <div class="space-y-3">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm uppercase tracking-[0.35em] text-sky-500">Consulta pública</p>
                        <h1 class="mt-3 text-3xl font-semibold text-slate-900 sm:text-4xl">Catálogo de equipamentos</h1>
                        <p class="mt-2 max-w-2xl text-sm leading-7 text-slate-600">Pesquise, filtre e visualize detalhes públicos dos ativos de TI com uma experiência responsiva e moderna.</p>
                    </div>
                    <a href="{{ route('public.home') }}#equipamentos" class="inline-flex items-center rounded-full bg-slate-900 px-4 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Voltar para o Início</a>
                </div>

                @include('public.components.search-filters', [
                    'categories' => $categories,
                    'brands' => $brands,
                    'sectors' => $sectors,
                    'statuses' => $statuses,
                    'filters' => $filters,
                ])
            </div>

            <section class="grid gap-6 xl:grid-cols-[1fr_280px]">
                <div class="space-y-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <div class="flex items-center justify-between gap-4">
                            <div>
                                <p class="text-sm font-medium text-slate-500">Resultados</p>
                                <p class="mt-2 text-2xl font-semibold text-slate-900">{{ $equipments->total() }} equipamentos encontrados</p>
                            </div>
                            <span class="rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">Página {{ $equipments->currentPage() }}</span>
                        </div>
                    </div>

                    <div class="grid gap-6 md:grid-cols-2">
                        @forelse ($equipments as $equipment)
                            @include('public.components.equipment-card', ['equipment' => $equipment])
                        @empty
                            <div class="rounded-3xl border border-slate-200 bg-white p-8 text-center text-slate-500 shadow-sm">
                                <p class="text-base font-semibold">Nenhum equipamento encontrado.</p>
                                <p class="mt-2 text-sm">Ajuste os filtros ou use outro termo de pesquisa.</p>
                            </div>
                        @endforelse
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 text-slate-700 shadow-sm">
                        {{ $equipments->links() }}
                    </div>
                </div>

                <aside class="space-y-6">
                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-base font-semibold text-slate-900">Filtros rápidos</h2>
                        <p class="mt-2 text-sm leading-6 text-slate-500">Use o campo de busca para localizar ativos por nome ou patrimônio.</p>
                    </div>

                    <div class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                        <h2 class="text-base font-semibold text-slate-900">Status disponíveis</h2>
                        <div class="mt-4 flex flex-wrap gap-2">
                            @foreach ($statuses as $value => $label)
                                <span class="rounded-full border border-slate-200 bg-slate-50 px-3 py-1 text-xs font-semibold text-slate-700">{{ $label }}</span>
                            @endforeach
                        </div>
                    </div>
                </aside>
            </section>
        </div>
    </main>
@endsection
