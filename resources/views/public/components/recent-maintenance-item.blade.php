{{-- Recent Maintenance Item Component
    Displays maintenance record with equipment link, maintenance type, date and status badge.
    Responsive layout: stacked on mobile, tabular on desktop (md+).
    
    Props:
    - $maintenance (Maintenance): Maintenance model instance with equipment relationship loaded
--}}
<article class="grid gap-4 rounded-3xl border border-slate-200 bg-white p-5 shadow-sm md:grid-cols-[minmax(0,2fr)_1fr_1fr_auto] md:items-center">
    <div class="min-w-0">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Equipamento</p>
        @if ($maintenance->equipment)
            <a href="{{ route('public.equipments.show', $maintenance->equipment) }}" class="mt-2 block break-words text-sm font-semibold text-slate-900 hover:text-sky-700">
                {{ $maintenance->equipment->name }}
            </a>
        @else
            <p class="mt-2 text-sm font-semibold text-slate-900">Equipamento não informado</p>
        @endif
    </div>

    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Tipo</p>
        <p class="mt-2 text-sm text-slate-700">{{ $maintenance->maintenance_type }}</p>
    </div>

    <div>
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500">Data</p>
        <p class="mt-2 text-sm text-slate-700">{{ $maintenance->maintenance_date->format('d/m/Y') }}</p>
    </div>

    <div class="md:justify-self-end">
        <p class="text-xs font-semibold uppercase tracking-[0.25em] text-slate-500 md:text-right">Status</p>
        <div class="mt-2 md:text-right">@include('maintenances.status-badge', ['status' => $maintenance->status])</div>
    </div>
</article>
