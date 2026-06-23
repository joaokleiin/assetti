<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                    {{ $maintenance->maintenance_type }}
                </h2>
                <p class="mt-1 text-sm text-gray-500">
                    {{ $maintenance->equipment->name }} - {{ $maintenance->equipment->asset_number }}
                </p>
            </div>

            <div class="flex gap-3">
                <a href="{{ route('maintenances.index') }}" class="inline-flex items-center rounded-md border border-gray-300 bg-white px-4 py-2 text-xs font-semibold uppercase tracking-widest text-gray-700 shadow-sm transition hover:bg-gray-50">
                    Voltar
                </a>
                <a href="{{ route('maintenances.edit', $maintenance) }}" class="inline-flex items-center rounded bg-indigo-600 px-4 py-2 text-sm font-semibold text-white transition hover:bg-indigo-700">
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
                        <dd class="mt-2">@include('maintenances.status-badge', ['status' => $maintenance->status])</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Responsável</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">{{ $maintenance->user->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Data</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">{{ $maintenance->maintenance_date->format('d/m/Y') }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Equipamento</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">
                            <a href="{{ route('equipments.show', $maintenance->equipment) }}" class="text-indigo-600 hover:text-indigo-900">
                                {{ $maintenance->equipment->name }}
                            </a>
                        </dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Categoria</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">{{ $maintenance->equipment->category->name }}</dd>
                    </div>
                    <div>
                        <dt class="text-xs font-semibold uppercase tracking-wider text-gray-500">Custo estimado</dt>
                        <dd class="mt-2 text-sm font-medium text-gray-900">
                            {{ $maintenance->estimated_cost !== null ? 'R$ '.number_format((float) $maintenance->estimated_cost, 2, ',', '.') : '-' }}
                        </dd>
                    </div>
                </div>
            </div>

            <div class="grid gap-6 md:grid-cols-2">
                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-base font-semibold text-gray-900">Problema</h3>
                    <p class="mt-3 whitespace-pre-line text-sm leading-6 text-gray-600">{{ $maintenance->problem_description }}</p>
                </div>

                <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                    <h3 class="text-base font-semibold text-gray-900">Solução</h3>
                    <p class="mt-3 whitespace-pre-line text-sm leading-6 text-gray-600">{{ $maintenance->solution_description ?: 'Nenhuma solução informada.' }}</p>
                </div>
            </div>

            <div class="bg-white p-6 shadow-sm sm:rounded-lg">
                <h3 class="text-base font-semibold text-gray-900">Observações</h3>
                <p class="mt-3 whitespace-pre-line text-sm leading-6 text-gray-600">{{ $maintenance->notes ?: 'Nenhuma observação informada.' }}</p>
            </div>

            <div class="flex justify-end">
                <form method="POST" action="{{ route('maintenances.destroy', $maintenance) }}" onsubmit="return confirm('Excluir esta manutenção?')">
                    @csrf
                    @method('DELETE')
                    <x-danger-button>Excluir manutenção</x-danger-button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
