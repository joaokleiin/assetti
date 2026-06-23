<article class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm transition hover:-translate-y-1 hover:shadow-md">
    <div class="flex items-start justify-between gap-4">
        <div>
            <p class="text-sm font-medium uppercase tracking-[0.25em] text-slate-500">{{ $equipment->category->name }}</p>
            <h3 class="mt-3 text-xl font-semibold text-slate-900">{{ $equipment->name }}</h3>
            <p class="mt-2 text-sm text-slate-600">Patrimônio {{ $equipment->asset_number }}</p>
        </div>
        <div class="shrink-0">@include('equipments.status-badge', ['status' => $equipment->status])</div>
    </div>

    <div class="mt-5 grid gap-4 text-sm text-slate-600 sm:grid-cols-2">
        <div><span class="font-semibold text-slate-900">Marca:</span> {{ $equipment->brand->name }}</div>
        <div><span class="font-semibold text-slate-900">Setor:</span> {{ $equipment->sector->name }}</div>
    </div>

    <div class="mt-6 flex items-center justify-between gap-3">
        <span class="text-xs uppercase tracking-[0.25em] text-slate-500">Publicado</span>
        <a href="{{ route('public.equipments.show', $equipment) }}" class="inline-flex items-center rounded-full bg-slate-900 px-4 py-2 text-sm font-semibold text-white transition hover:bg-slate-800">Ver detalhes</a>
    </div>
</article>
