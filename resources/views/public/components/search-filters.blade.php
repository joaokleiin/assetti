<section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm">
    <form action="{{ route('public.equipments.index') }}" method="GET" class="space-y-6">
        <div class="grid gap-4 md:grid-cols-2 lg:grid-cols-3">
            <label class="block">
                <span class="text-sm font-medium text-slate-700">Buscar</span>
                <input name="search" value="{{ $filters['search'] ?? '' }}" type="search" placeholder="Nome ou patrimônio" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-sky-200" />
            </label>
            <label class="block">
                <span class="text-sm font-medium text-slate-700">Categoria</span>
                <select name="category_id" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-sky-200">
                    <option value="">Todas</option>
                    @foreach ($categories as $category)
                        <option value="{{ $category->id }}" @selected(($filters['category_id'] ?? null) == $category->id)>{{ $category->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="text-sm font-medium text-slate-700">Marca</span>
                <select name="brand_id" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-sky-200">
                    <option value="">Todas</option>
                    @foreach ($brands as $brand)
                        <option value="{{ $brand->id }}" @selected(($filters['brand_id'] ?? null) == $brand->id)>{{ $brand->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="text-sm font-medium text-slate-700">Setor</span>
                <select name="sector_id" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-sky-200">
                    <option value="">Todos</option>
                    @foreach ($sectors as $sector)
                        <option value="{{ $sector->id }}" @selected(($filters['sector_id'] ?? null) == $sector->id)>{{ $sector->name }}</option>
                    @endforeach
                </select>
            </label>
            <label class="block">
                <span class="text-sm font-medium text-slate-700">Status</span>
                <select name="status" class="mt-2 w-full rounded-3xl border border-slate-200 bg-slate-50 px-4 py-3 text-sm text-slate-900 outline-none transition focus:border-slate-400 focus:ring-2 focus:ring-sky-200">
                    <option value="">Todos</option>
                    @foreach ($statuses as $value => $label)
                        <option value="{{ $value }}" @selected(($filters['status'] ?? null) == $value)>{{ $label }}</option>
                    @endforeach
                </select>
            </label>
        </div>

        <div class="flex flex-col gap-3 sm:flex-row sm:items-center sm:justify-between">
            <button type="submit" class="inline-flex items-center justify-center rounded-full bg-slate-900 px-5 py-3 text-sm font-semibold text-white transition hover:bg-slate-800">Aplicar filtros</button>
            <a href="{{ route('public.equipments.index') }}" class="inline-flex items-center justify-center rounded-full border border-slate-200 bg-white px-5 py-3 text-sm font-semibold text-slate-700 transition hover:bg-slate-50">Limpar filtros</a>
        </div>
    </form>
</section>
