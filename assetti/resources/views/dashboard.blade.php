<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Área administrativa') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="mb-6">
                        <h3 class="text-lg font-semibold text-gray-900">AssetTI</h3>
                        <p class="mt-1 text-sm text-gray-600">Base administrativa inicial do sistema.</p>
                    </div>

                    <div class="grid gap-4 md:grid-cols-3">
                        <a href="{{ route('categories.index') }}" class="rounded border border-gray-200 p-4 transition hover:border-indigo-300 hover:bg-indigo-50">
                            <span class="text-sm font-semibold text-gray-900">Categorias</span>
                            <span class="mt-1 block text-sm text-gray-600">Tipos de equipamentos</span>
                        </a>
                        <a href="{{ route('brands.index') }}" class="rounded border border-gray-200 p-4 transition hover:border-indigo-300 hover:bg-indigo-50">
                            <span class="text-sm font-semibold text-gray-900">Marcas</span>
                            <span class="mt-1 block text-sm text-gray-600">Fabricantes cadastrados</span>
                        </a>
                        <a href="{{ route('sectors.index') }}" class="rounded border border-gray-200 p-4 transition hover:border-indigo-300 hover:bg-indigo-50">
                            <span class="text-sm font-semibold text-gray-900">Setores</span>
                            <span class="mt-1 block text-sm text-gray-600">Áreas responsáveis</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
