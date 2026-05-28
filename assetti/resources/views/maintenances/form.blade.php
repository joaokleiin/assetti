<div>
    <h3 class="text-base font-semibold text-gray-900">Dados da manutenção</h3>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <x-input-label for="equipment_id" :value="__('Equipamento')" />
            <select id="equipment_id" name="equipment_id" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                <option value="">Selecione</option>
                @foreach ($equipments as $equipment)
                    <option value="{{ $equipment->id }}" @selected((string) old('equipment_id', $maintenance->equipment_id) === (string) $equipment->id)>
                        {{ $equipment->name }} - {{ $equipment->asset_number }}
                    </option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('equipment_id')" />
        </div>

        <div>
            <x-input-label for="maintenance_type" :value="__('Tipo de manutenção')" />
            <x-text-input id="maintenance_type" name="maintenance_type" type="text" class="mt-1 block w-full" :value="old('maintenance_type', $maintenance->maintenance_type)" required />
            <x-input-error class="mt-2" :messages="$errors->get('maintenance_type')" />
        </div>

        <div>
            <x-input-label for="maintenance_date" :value="__('Data da manutenção')" />
            <x-text-input id="maintenance_date" name="maintenance_date" type="date" class="mt-1 block w-full" :value="old('maintenance_date', $maintenance->maintenance_date?->format('Y-m-d'))" required />
            <x-input-error class="mt-2" :messages="$errors->get('maintenance_date')" />
        </div>

        <div>
            <x-input-label for="estimated_cost" :value="__('Custo estimado')" />
            <x-text-input id="estimated_cost" name="estimated_cost" type="number" min="0" step="0.01" class="mt-1 block w-full" :value="old('estimated_cost', $maintenance->estimated_cost)" />
            <x-input-error class="mt-2" :messages="$errors->get('estimated_cost')" />
        </div>

        <div>
            <x-input-label for="status" :value="__('Status')" />
            <select id="status" name="status" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>
                @foreach ($statuses as $value => $label)
                    <option value="{{ $value }}" @selected(old('status', $maintenance->status) === $value)>{{ $label }}</option>
                @endforeach
            </select>
            <x-input-error class="mt-2" :messages="$errors->get('status')" />
        </div>
    </div>
</div>

<div>
    <h3 class="text-base font-semibold text-gray-900">Descrição técnica</h3>
    <div class="mt-4 grid gap-6 md:grid-cols-2">
        <div>
            <x-input-label for="problem_description" :value="__('Descrição do problema')" />
            <textarea id="problem_description" name="problem_description" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500" required>{{ old('problem_description', $maintenance->problem_description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('problem_description')" />
        </div>

        <div>
            <x-input-label for="solution_description" :value="__('Descrição da solução')" />
            <textarea id="solution_description" name="solution_description" rows="6" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('solution_description', $maintenance->solution_description) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('solution_description')" />
        </div>

        <div class="md:col-span-2">
            <x-input-label for="notes" :value="__('Observações')" />
            <textarea id="notes" name="notes" rows="4" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-500 focus:ring-indigo-500">{{ old('notes', $maintenance->notes) }}</textarea>
            <x-input-error class="mt-2" :messages="$errors->get('notes')" />
        </div>
    </div>
</div>
