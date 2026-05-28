<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $equipment->name }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">Patrimônio {{ $equipment->asset_number }}</p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('equipments.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition hover:bg-gray-50">
                    Voltar
                </a>
                <a href="{{ route('equipments.edit', $equipment) }}" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700">
                    Editar
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-5xl mx-auto space-y-6 sm:px-6 lg:px-8">
            @if (session('success'))
                <div class="rounded border border-green-200 bg-green-50 px-4 py-3 text-sm text-green-800">
                    {{ session('success') }}
                </div>
            @endif

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="grid gap-6 p-6 md:grid-cols-3">
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Status</dt>
                        <dd class="mt-2">@include('equipments.status-badge', ['status' => $equipment->status])</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Categoria</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">{{ $equipment->category->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Marca</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">{{ $equipment->brand->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Setor</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">{{ $equipment->sector->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Número de série</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">{{ $equipment->serial_number ?: '-' }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Data de aquisição</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">{{ $equipment->acquisition_date?->format('d/m/Y') ?: '-' }}</dd>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-base font-semibold text-gray-900">Descrição</h3>
                    <p class="mt-3 whitespace-pre-line text-sm leading-6 text-gray-600">{{ $equipment->description ?: 'Nenhuma descrição informada.' }}</p>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-base font-semibold text-gray-900">Observações</h3>
                    <p class="mt-3 whitespace-pre-line text-sm leading-6 text-gray-600">{{ $equipment->notes ?: 'Nenhuma observação informada.' }}</p>
                </div>
            </div>

            <div class="bg-white shadow-sm sm:rounded-lg">
                <div class="flex flex-col gap-4 border-b border-gray-200 p-6 sm:flex-row sm:items-center sm:justify-between">
                    <div>
                        <h3 class="text-base font-semibold text-gray-900">Histórico de manutenções</h3>
                        <p class="mt-1 text-sm text-gray-500">Registros vinculados a este equipamento.</p>
                    </div>
                    <a href="{{ route('maintenances.create', ['equipment_id' => $equipment->id]) }}" class="inline-flex items-center justify-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700">
                        Nova manutenção
                    </a>
                </div>

                <div class="overflow-x-auto">
                    <table class="min-w-full divide-y divide-gray-200">
                        <thead class="bg-gray-50">
                            <tr>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Data</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Tipo</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Status</th>
                                <th scope="col" class="px-6 py-3 text-left text-xs font-semibold uppercase tracking-wider text-gray-500">Responsável</th>
                                <th scope="col" class="px-6 py-3 text-right text-xs font-semibold uppercase tracking-wider text-gray-500">Ações</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-200 bg-white">
                            @forelse ($maintenances as $maintenance)
                                <tr class="hover:bg-gray-50">
                                    <td class="whitespace-nowrap px-6 py-4 text-sm text-gray-700">{{ $maintenance->maintenance_date->format('d/m/Y') }}</td>
                                    <td class="px-6 py-4 text-sm font-medium text-gray-900">{{ $maintenance->maintenance_type }}</td>
                                    <td class="whitespace-nowrap px-6 py-4">
                                        @include('maintenances.status-badge', ['status' => $maintenance->status])
                                    </td>
                                    <td class="px-6 py-4 text-sm text-gray-700">{{ $maintenance->user->name }}</td>
                                    <td class="whitespace-nowrap px-6 py-4 text-right text-sm font-medium">
                                        <a href="{{ route('maintenances.show', $maintenance) }}" class="text-indigo-600 hover:text-indigo-900">Ver</a>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="5" class="px-6 py-8 text-center text-sm text-gray-500">Nenhuma manutenção registrada para este equipamento.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="flex justify-end">
                <form method="POST" action="{{ route('equipments.destroy', $equipment) }}" onsubmit="return confirm('Excluir este equipamento?')">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>Excluir equipamento</x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
