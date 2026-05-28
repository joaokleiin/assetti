<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ __('Manutenções') }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Acompanhamento das manutenções registradas nos equipamentos.</p>
            </div>

            <a href="{{ route('maintenances.create') }}" class="inline-flex items-center justify-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700">
                Nova manutenção
            </a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto space-y-6 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            @if ($errors->any())
                <div class="rounded border border-red-200 bg-red-50 px-4 py-3 text-sm text-red-800">
                    Revise os filtros informados e tente novamente.
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <form method="GET" action="{{ route('maintenances.index') }}" class="grid gap-4 p-6 lg:grid-cols-12">
                    <div class="lg:col-span-3">
                        <x-input-label for="search" :value="__('Busca')" />
                        <x-text-input id="search" name="search" type="text" class="mt-1 block w-full" :value="request('search')" placeholder="Descrição do problema" />
                    </div>

                    <div class="lg:col-span-3">
                        <x-input-label for="equipment_id" :value="__('Equipamento')" />
                        <select id="equipment_id" name="equipment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos</option>
                            @foreach ($equipments as $equipment)
                                <option value="{{ $equipment->id }}" @selected((string) request('equipment_id') === (string) $equipment->id)>
                                    {{ $equipment->name }} - {{ $equipment->asset_number }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lg:col-span-2">
                        <x-input-label for="status" :value="__('Status')" />
                        <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">
                            <option value="">Todos</option>
                            @foreach ($statuses as $value => $label)
                                <option value="{{ $value }}" @selected(request('status') === $value)>{{ $label }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="lg:col-span-2">
                        <x-input-label for="date_from" :value="__('De')" />
                        <x-text-input id="date_from" name="date_from" type="date" class="mt-1 block w-full" :value="request('date_from')" />
                    </div>

                    <div class="lg:col-span-2">
                        <x-input-label for="date_to" :value="__('Até')" />
                        <x-text-input id="date_to" name="date_to" type="date" class="mt-1 block w-full" :value="request('date_to')" />
                    </div>

                    <div class="flex items-end gap-3 lg:col-span-12">
                        <x-primary-button class="justify-center">Filtrar</x-primary-button>
                        <a href="{{ route('maintenances.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition hover:bg-gray-50">
                            Limpar
                        </a>
                    </div>
                </form>
            </div>

            <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Equipamento</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Responsável</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Data</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($maintenances as $maintenance)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-6 py-4">
                                        <div class="text-sm font-semibold text-gray-900">{{ $maintenance->equipment->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $maintenance->equipment->asset_number }}</div>
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $maintenance->maintenance_type }}</td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $maintenance->user->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $maintenance->maintenance_date->format('d/m/Y') }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @include('maintenances.status-badge', ['status' => $maintenance->status])
                                    </td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <div class="flex justify-end gap-3">
                                            <a href="{{ route('maintenances.show', $maintenance) }}" class="text-gray-700 hover:text-gray-900">Ver</a>
                                            <a href="{{ route('maintenances.edit', $maintenance) }}" class="text-indigo-600 hover:text-indigo-900">Editar</a>
                                            <form method="POST" action="{{ route('maintenances.destroy', $maintenance) }}" onsubmit="return confirm('Excluir esta manutenção?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="text-red-600 hover:text-red-900">Excluir</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-6 py-8 text-center text-sm text-gray-500">Nenhuma manutenção encontrada.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="border-t border-gray-200 px-6 py-4">
                    {{ $maintenances->links() }}
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
