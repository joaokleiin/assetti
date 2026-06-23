{{-- Recent Equipment Card Component
    Displays equipment information with category, status badge, and link to details.
    
    Props:
    - $equipment (Equipment): Equipment model instance with category relationship loaded
--}}
<article class="flex h-full flex-col rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
    <div class="flex items-start justify-between gap-4">
        <div class="min-w-0">
            <p class="text-sm font-medium uppercase tracking-[0.25em] text-slate-500">{{ $equipment->category?->name ?? 'Sem categoria' }}</p>
            <h3 class="mt-3 break-words text-xl font-semibold text-slate-900">{{ $equipment->name }}</h3>
            <p class="mt-2 text-sm text-slate-600">Patrimônio {{ $equipment->asset_number }}</p>
        </div>
        <div class="shrink-0">@include('equipments.status-badge', ['status' => $equipment->status])</div>
    </div>

    <div class="mt-6 rounded-2xl bg-slate-50 p-4 text-sm text-slate-600">
        <span class="font-semibold text-slate-900">Categoria:</span>
        {{ $equipment->category?->name ?? 'Sem categoria' }}
    </div>

    <div class="mt-auto pt-6">
        <a href="{{ route('public.equipments.show', $equipment) }}" class="inline-flex w-full items-center justify-center rounded-full bg-slate-900 px-4 py-2.5 text-sm font-semibold text-white transition hover:bg-slate-800">
            Ver detalhes
        </a>
    </div>
</article>
