<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nova marca') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('brands.store') }}" class="space-y-6 p-6">
                    @csrf

                    @include('brands.form')

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('brands.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Cancelar</a>
                        <x-primary-button>Salvar</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
