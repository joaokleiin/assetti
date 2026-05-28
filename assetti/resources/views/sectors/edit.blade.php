<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Editar setor') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg">
                <form method="POST" action="{{ route('sectors.update', $sector) }}" class="space-y-6 p-6">
                    @csrf
                    @method('PUT')

                    @include('sectors.form')

                    <div class="flex items-center justify-end gap-3">
                        <a href="{{ route('sectors.index') }}" class="text-sm font-medium text-gray-600 hover:text-gray-900">Cancelar</a>
                        <x-primary-button>Atualizar</x-primary-button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
