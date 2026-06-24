<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-2 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">Dashboard administrativo</h2>
                <p class="mt-1 text-sm text-gray-600">Visão geral dos ativos e manutenções do AssetTI.</p>
            </div>
        </div>
    </x-slot>

    <div class="py-8">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-8">
            <div class="grid gap-6 grid-cols-1 md:grid-cols-2 xl:grid-cols-4">
                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Total de Equipamentos</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $totalEquipments }}</p>
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
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $equipmentsInUse }}</p>
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
                            <p class="text-sm font-medium text-slate-500">Equipamentos Disponíveis</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $equipmentsAvailable }}</p>
                        </div>
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-indigo-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Equipamentos em Manutenção</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $equipmentsMaintenance }}</p>
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
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $totalMaintenances }}</p>
                        </div>
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-slate-100 text-slate-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 17v-2a4 4 0 014-4h3" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm">
                    <div class="flex items-start justify-between gap-4">
                        <div>
                            <p class="text-sm font-medium text-slate-500">Manutenções Abertas</p>
                            <p class="mt-3 text-3xl font-semibold text-slate-900">{{ $openMaintenances }}</p>
                        </div>
                        <div class="inline-flex h-12 w-12 items-center justify-center rounded-2xl bg-cyan-100 text-cyan-700">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18.364 5.636a9 9 0 11-12.728 0" />
                            </svg>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Seção de gráficos: no desktop os dois primeiros ficam lado a lado e o terceiro ocupa toda a largura. --}}
            <section class="grid grid-cols-1 gap-6 lg:grid-cols-2">
                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900">Distribuição dos Equipamentos por Status</h3>
                        <p class="mt-1 text-sm text-slate-500">Participação de cada status no total de equipamentos cadastrados.</p>
                    </div>

                    <div class="mt-6 grid gap-6 md:grid-cols-[minmax(0,1fr)_220px] md:items-center">
                        <div class="relative h-72">
                            <canvas id="equipmentStatusChart" aria-label="Distribuição dos equipamentos por status" role="img"></canvas>
                        </div>

                        <ul class="space-y-3">
                            @foreach ($equipmentStatusChart['items'] as $statusItem)
                                <li class="flex items-center justify-between gap-4 rounded-xl bg-slate-50 px-3 py-2">
                                    <div class="flex min-w-0 items-center gap-3">
                                        <span class="h-3 w-3 shrink-0 rounded-full" style="background-color: {{ $statusItem['color'] }}"></span>
                                        <span class="truncate text-sm font-medium text-slate-700">{{ $statusItem['label'] }}</span>
                                    </div>
                                    <span class="shrink-0 text-sm font-semibold text-slate-900">
                                        {{ $statusItem['value'] }}
                                        <span class="font-medium text-slate-500">({{ number_format($statusItem['percentage'], 1, ',', '.') }}%)</span>
                                    </span>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900">Equipamentos por Categoria</h3>
                        <p class="mt-1 text-sm text-slate-500">Quantidade de equipamentos agrupada por categoria cadastrada.</p>
                    </div>

                    <div class="relative mt-6 h-72">
                        <canvas id="equipmentCategoryChart" aria-label="Equipamentos por categoria" role="img"></canvas>
                    </div>
                </article>

                <article class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2">
                    <div>
                        <h3 class="text-base font-semibold text-slate-900">Manutenções Registradas por Mês</h3>
                        <p class="mt-1 text-sm text-slate-500">Volume mensal de manutenções registradas nos últimos 12 meses.</p>
                    </div>

                    <div class="relative mt-6 h-80">
                        <canvas id="maintenanceMonthChart" aria-label="Manutenções registradas por mês" role="img"></canvas>
                    </div>
                </article>
            </section>
        </div>
    </div>

    @push('scripts')
        {{-- Chart.js via CDN, mantendo a view Blade simples e sem dependência de Livewire ou Vue. --}}
        <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
        <script>
            document.addEventListener('DOMContentLoaded', () => {
                if (!window.Chart) {
                    return;
                }

                // Dados preparados no DashboardController para serem consumidos diretamente pelo Chart.js.
                const equipmentStatusChart = {{ Illuminate\Support\Js::from($equipmentStatusChart) }};
                const equipmentCategoryChart = {{ Illuminate\Support\Js::from($equipmentCategoryChart) }};
                const maintenanceMonthChart = {{ Illuminate\Support\Js::from($maintenanceMonthChart) }};

                const numberFormatter = new Intl.NumberFormat('pt-BR');
                const percentFormatter = new Intl.NumberFormat('pt-BR', {
                    minimumFractionDigits: 0,
                    maximumFractionDigits: 1,
                });

                Chart.defaults.color = '#475569';
                Chart.defaults.font.family = "'Figtree', sans-serif";

                // Plugin local para indicar visualmente quando um gráfico não possui registros.
                const emptyChartPlugin = {
                    id: 'emptyChartPlugin',
                    beforeDraw(chart) {
                        const values = chart.data.datasets.flatMap((dataset) => dataset.data || []);
                        const hasData = values.some((value) => Number(value) > 0);

                        if (hasData || !chart.chartArea) {
                            return;
                        }

                        const {ctx, chartArea} = chart;
                        ctx.save();
                        ctx.fillStyle = '#94a3b8';
                        ctx.font = '500 14px Figtree, sans-serif';
                        ctx.textAlign = 'center';
                        ctx.textBaseline = 'middle';
                        ctx.fillText('Sem dados para exibir', (chartArea.left + chartArea.right) / 2, (chartArea.top + chartArea.bottom) / 2);
                        ctx.restore();
                    },
                };

                Chart.register(emptyChartPlugin);

                const sharedGridOptions = {
                    color: '#e2e8f0',
                    drawBorder: false,
                };

                // Pizza: mostra a distribuição por status com quantidade e percentual no tooltip.
                new Chart(document.getElementById('equipmentStatusChart'), {
                    type: 'pie',
                    data: {
                        labels: equipmentStatusChart.labels,
                        datasets: [{
                            data: equipmentStatusChart.values,
                            backgroundColor: equipmentStatusChart.colors,
                            borderColor: '#ffffff',
                            borderWidth: 3,
                            hoverOffset: 8,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                callbacks: {
                                    label(context) {
                                        const value = Number(context.raw || 0);
                                        const percentage = equipmentStatusChart.percentages[context.dataIndex] || 0;

                                        return `${context.label}: ${numberFormatter.format(value)} (${percentFormatter.format(percentage)}%)`;
                                    },
                                },
                            },
                        },
                    },
                });

                // Barras horizontais: facilita a leitura dos nomes das categorias em telas menores.
                new Chart(document.getElementById('equipmentCategoryChart'), {
                    type: 'bar',
                    data: {
                        labels: equipmentCategoryChart.labels,
                        datasets: [{
                            label: 'Equipamentos',
                            data: equipmentCategoryChart.values,
                            backgroundColor: '#2563eb',
                            borderColor: '#1d4ed8',
                            borderWidth: 1,
                            borderRadius: 8,
                            maxBarThickness: 34,
                        }],
                    },
                    options: {
                        indexAxis: 'y',
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                callbacks: {
                                    label(context) {
                                        return ` ${numberFormatter.format(context.raw || 0)} equipamento(s)`;
                                    },
                                },
                            },
                        },
                        scales: {
                            x: {
                                beginAtZero: true,
                                grid: sharedGridOptions,
                                ticks: {
                                    precision: 0,
                                },
                            },
                            y: {
                                grid: {
                                    display: false,
                                },
                                ticks: {
                                    autoSkip: false,
                                },
                            },
                        },
                    },
                });

                // Linha: acompanha a evolução mensal das manutenções registradas nos últimos 12 meses.
                new Chart(document.getElementById('maintenanceMonthChart'), {
                    type: 'line',
                    data: {
                        labels: maintenanceMonthChart.labels,
                        datasets: [{
                            label: 'Manutenções',
                            data: maintenanceMonthChart.values,
                            borderColor: '#0284c7',
                            backgroundColor: 'rgba(2, 132, 199, 0.12)',
                            borderWidth: 3,
                            pointBackgroundColor: '#ffffff',
                            pointBorderColor: '#0284c7',
                            pointBorderWidth: 2,
                            pointRadius: 4,
                            pointHoverRadius: 6,
                            fill: true,
                            tension: 0.35,
                        }],
                    },
                    options: {
                        responsive: true,
                        maintainAspectRatio: false,
                        plugins: {
                            legend: {
                                display: false,
                            },
                            tooltip: {
                                callbacks: {
                                    label(context) {
                                        return ` ${numberFormatter.format(context.raw || 0)} manutenção(ões)`;
                                    },
                                },
                            },
                        },
                        scales: {
                            x: {
                                grid: {
                                    display: false,
                                },
                            },
                            y: {
                                beginAtZero: true,
                                grid: sharedGridOptions,
                                ticks: {
                                    precision: 0,
                                },
                            },
                        },
                    },
                });
            });
        </script>
    @endpush
</x-app-layout>
