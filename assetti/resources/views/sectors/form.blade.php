<div>
    <x-input-label for="name" :value="__('Nome')" />
    <x-text-input id="name" name="name" type="text" class="mt-1 block w-full" :value="old('name', $sector->name)" required autofocus />
    <x-input-error class="mt-2" :messages="$errors->get('name')" />
</div>

<div>
    <x-input-label for="responsible" :value="__('Responsável')" />
    <x-text-input id="responsible" name="responsible" type="text" class="mt-1 block w-full" :value="old('responsible', $sector->responsible)" />
    <x-input-error class="mt-2" :messages="$errors->get('responsible')" />
</div>

<div>
    <x-input-label for="location" :value="__('Localização')" />
    <x-text-input id="location" name="location" type="text" class="mt-1 block w-full" :value="old('location', $sector->location)" />
    <x-input-error class="mt-2" :messages="$errors->get('location')" />
</div>
