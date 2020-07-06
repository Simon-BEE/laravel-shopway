@props(['class', 'label', 'name', 'value', 'checked', 'disabled'])
<div class="flex flex-col mb-6">
    <label class="inline-flex items-center text-sm text-gray-700" for="{{ $name }}">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-checkbox"
            value="{{ $value ?? '' }}"
            {{ ($checked ?? false) ? 'checked' : '' }}
            {{ ($disabled ?? false) ? 'disabled' : '' }}
            {{ $attributes }}
        />
        <span class="ml-2 mr-4">{{ __($label) }}</span>
    </label>

    @error($name)
        <x-form.error>
            {{ $message }}
        </x-form.error>
    @enderror
</div>
