<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm uppercase tracking-[0.35em] text-sky-500">Relatórios</p>
                <h2 class="mt-3 text-3xl font-semibold text-slate-900 sm:text-4xl">Análise de ativos e manutenções</h2>
                <p class="mt-2 text-sm leading-6 text-slate-600">Filtre e exporte os dados com o mesmo padrão visual do AssetTI.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            {{-- Filters Card --}}
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-6 lg:flex-row lg:items-center lg:justify-between">
                    <div class="flex items-center gap-4">
                        <span class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 5h18M7 11h10M10 17h4" />
                            </svg>
                        </span>
                        <div>
                            <p class="text-sm font-semibold text-slate-900">Filtros de Relatório</p>
                            <p class="mt-1 text-sm text-slate-500">Selecione os critérios para refinar os equipamentos e manutenções visíveis.</p>
                        </div>
                    </div>
                </div>

                <form method="GET" action="{{ route('reports.index') }}" class="mt-8 space-y-6">
                    <div class="grid gap-4 md:grid-cols-2 xl:grid-cols-3">
                        <div>
                            <label for="category_id" class="block text-sm font-medium text-slate-700">Categoria</label>
                            <select id="category_id" name="category_id" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
                                <option value="">Todas as categorias</option>
                                @foreach ($categories as $id => $name)
                                    <option value="{{ $id }}" @selected(request('category_id') == $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="sector_id" class="block text-sm font-medium text-slate-700">Setor</label>
                            <select id="sector_id" name="sector_id" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
                                <option value="">Todos os setores</option>
                                @foreach ($sectors as $id => $name)
                                    <option value="{{ $id }}" @selected(request('sector_id') == $id)>{{ $name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="equipment_status" class="block text-sm font-medium text-slate-700">Status do Equipamento</label>
                            <select id="equipment_status" name="equipment_status" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
                                <option value="">Todos os status</option>
                                @foreach ($equipmentStatuses as $value => $label)
                                    <option value="{{ $value }}" @selected(request('equipment_status') == $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="maintenance_status" class="block text-sm font-medium text-slate-700">Status de Manutenção</label>
                            <select id="maintenance_status" name="maintenance_status" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100">
                                <option value="">Todos os status</option>
                                @foreach ($maintenanceStatuses as $value => $label)
                                    <option value="{{ $value }}" @selected(request('maintenance_status') == $value)>{{ $label }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div>
                            <label for="date_from" class="block text-sm font-medium text-slate-700">Data Inicial</label>
                            <input type="date" id="date_from" name="date_from" value="{{ request('date_from') }}" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        </div>

                        <div>
                            <label for="date_to" class="block text-sm font-medium text-slate-700">Data Final</label>
                            <input type="date" id="date_to" name="date_to" value="{{ request('date_to') }}" class="mt-2 block w-full rounded-2xl border border-slate-200 bg-white px-4 py-3 text-sm text-slate-700 shadow-sm focus:border-sky-500 focus:outline-none focus:ring-2 focus:ring-sky-100" />
                        </div>
                    </div>

                    <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
                        <button type="submit" class="inline-flex items-center justify-center gap-2 rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h16" />
                            </svg>
                            Aplicar filtros
                        </button>

                        <a href="{{ route('reports.index') }}" class="inline-flex items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                            </svg>
                            Limpar filtros
                        </a>
                    </div>
                </form>
            </section>

            {{-- Summary Cards --}}
            <section class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total de Equipamentos</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $summary['totalEquipments'] }}</p>
                        </div>
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-sky-100 text-sky-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9.75 17L15 12.75 9.75 8.5" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Equipamentos em Uso</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $summary['equipmentsInUse'] }}</p>
                        </div>
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-emerald-100 text-emerald-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Equipamentos em Manutenção</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $summary['equipmentsInMaintenance'] }}</p>
                        </div>
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-amber-100 text-amber-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.5 12a8.5 8.5 0 11-17 0 8.5 8.5 0 0117 0z" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total de Manutenções</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $summary['totalMaintenances'] }}</p>
                        </div>
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16" />
                            </svg>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Export Buttons --}}
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Exportações</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">Baixar relatórios</h3>
                    </div>
                    <div class="grid w-full gap-3 sm:w-auto sm:grid-cols-2">
                        <form method="GET" action="{{ route('reports.export.pdf') }}">
                            @foreach ($filters as $key => $value)
                                @if (!empty($value))
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                                @endif
                            @endforeach
                            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white shadow-sm transition hover:bg-slate-800">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-3-3v6m-7 6h10a2 2 0 002-2V6a2 2 0 00-2-2H8a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                Exportar PDF
                            </button>
                        </form>
                        <form method="GET" action="{{ route('reports.export.csv') }}">
                            @foreach ($filters as $key => $value)
                                @if (!empty($value))
                                    <input type="hidden" name="{{ $key }}" value="{{ $value }}" />
                                @endif
                            @endforeach
                            <button type="submit" class="inline-flex w-full items-center justify-center gap-2 rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 shadow-sm transition hover:bg-slate-50">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 16v2a2 2 0 002 2h12a2 2 0 002-2v-2" />
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 10l5 5 5-5" />
                                </svg>
                                Exportar CSV
                            </button>
                        </form>
                    </div>
                </div>
            </section>

            {{-- Equipamentos Table --}}
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Equipamentos</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">Tabela de equipamentos</h3>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">{{ $equipments->count() }} registros</span>
                </div>

                @if ($equipments->isNotEmpty())
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="border-t border-slate-200 bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Patrimônio</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Nome</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Categoria</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Marca</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Setor</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach ($equipments as $equipment)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-slate-900">{{ $equipment->asset_number }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $equipment->name }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $equipment->category?->name ?? '—' }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $equipment->brand?->name ?? '—' }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $equipment->sector?->name ?? '—' }}</td>
                                        <td class="px-6 py-4 text-sm">@include('equipments.status-badge', ['status' => $equipment->status])</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="mt-6 rounded-3xl border border-slate-200 bg-slate-50 p-8 text-center text-slate-500">
                        <p class="text-base font-semibold">Nenhum registro encontrado para os filtros informados.</p>
                        <p class="mt-2 text-sm">Ajuste os filtros ou remova algum critério para exibir resultados.</p>
                    </div>
                @endif
            </section>

            {{-- Maintenances Table --}}
            <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
                <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <p class="text-sm font-medium text-slate-500">Manutenções</p>
                        <h3 class="mt-2 text-xl font-semibold text-slate-900">Tabela de manutenções</h3>
                    </div>
                    <span class="inline-flex items-center rounded-full bg-slate-100 px-3 py-1 text-sm font-semibold text-slate-700">{{ $maintenances->count() }} registros</span>
                </div>

                @if ($maintenances->isNotEmpty())
                    <div class="mt-6 overflow-x-auto">
                        <table class="min-w-full divide-y divide-slate-200">
                            <thead class="border-t border-slate-200 bg-slate-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Equipamento</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Tipo de manutenção</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Data</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Status</th>
                                    <th class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-slate-500">Técnico</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-slate-200 bg-white">
                                @foreach ($maintenances as $maintenance)
                                    <tr class="hover:bg-slate-50">
                                        <td class="px-6 py-4 text-sm font-medium text-slate-900">{{ $maintenance->equipment?->name ?? '—' }}</td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $maintenance->maintenance_type }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-slate-600">{{ $maintenance->maintenance_date->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4 text-sm">@include('maintenances.status-badge', ['status' => $maintenance->status])</td>
                                        <td class="px-6 py-4 text-sm text-slate-600">{{ $maintenance->user?->name ?? '—' }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="mt-6 rounded-3xl border border-slate-200 bg-slate-50 p-8 text-center text-slate-500">
                        <p class="text-base font-semibold">Nenhum registro encontrado para os filtros informados.</p>
                        <p class="mt-2 text-sm">Ajuste os filtros ou remova algum critério para exibir resultados.</p>
                    </div>
                @endif
            </section>
        </div>
    </div>
</x-app-layout>
