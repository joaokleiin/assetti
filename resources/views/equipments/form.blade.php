<div>
    <h3 class="text-base font-semibold text-gray-900">Identificação</h3>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <x-input-label for="name" :value="__('Nome')" />
            <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $equipment->name)" required autofocus />
            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>

        <div>
            <x-input-label for="asset_number" :value="__('Patrimônio')" />
            <x-text-input id="asset_number" name="asset_number" type="text" class="mt-1 block w-full" :value="old('asset_number', $equipment->asset_number)" required />
            <x-input-error class="mt-2" :messages="$errors->get('asset_number')" />
        </div>

        <div>
            <x-input-label for="serial_number" :value="__('Número de série')" />
            <x-text-input id="serial_number" name="serial_number" type="text" class="mt-1 block w-full" :value="old('serial_number', $equipment->serial_number)" />
            <x-input-error class="mt-2" :messages="$errors->get('serial_number')" />
        </div>

        <div>
            <x-input-label for="acquisition_date" :value="__('Data de aquisição')" />
            <x-text-input id="acquisition_date" name="acquisition_date" type="date" class="mt-1 block w-full" :value="old('acquisition_date', $equipment->acquisition_date?->format('Y-m-d'))" />
            <x-input-error class="mt-2" :messages="$errors->get('acquisition_date')" />
        </div>
    </div>
</div>

<div>
    <h3 class="text-base font-semibold text-gray-900">Classificação e localização</h3>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <x-input-label for="category_id" :value="__('Categoria')" />
            <select id="category_id" name="category_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Selecione</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" @selected((string) old('category_id', $equipment->category_id) === (string) $category->id)>{{ $category->name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('category_id')" />
        </div>

        <div>
            <x-input-label for="brand_id" :value="__('Marca')" />
            <select id="brand_id" name="brand_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Selecione</option>
                @foreach ($brands as $brand)
                    <option value="{{ $brand->id }}" @selected((string) old('brand_id', $equipment->brand_id) === (string) $brand->id)>{{ $brand->name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('brand_id')" />
        </div>

        <div>
            <x-input-label for="sector_id" :value="__('Setor')" />
            <select id="sector_id" name="sector_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Selecione</option>
                @foreach ($sectors as $sector)
                    <option value="{{ $sector->id }}" @selected((string) old('sector_id', $equipment->sector_id) === (string) $sector->id)>{{ $sector->name }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('sector_id')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $equipment->status) === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>
    </div>
</div>

<div>
    <h3 class="text-base font-semibold text-gray-900">Informações complementares</h3>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <x-input-label for="description" :value="__('Descrição')" />
            <textarea id="description" name="description" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('description', $equipment->description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('description')" />
        </div>

        <div>
            <x-input-label for="notes" :value="__('Observações')" />
            <textarea id="notes" name="notes" rows="5" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $equipment->notes) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
        </div>
    </div>
</div>
