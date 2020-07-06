@props(['classDiv', 'class', 'label', 'name', 'value', 'checked'])
<label
    class="flex justify-start items-center text-truncate {{ $classDiv ?? '' }}"
>
    <div class="{{ isset($classDiv) ? '' : 'mr-3' }}">
        <input
            type="radio"
            class="form-radio focus:outline-none focus:shadow-outline @error($name) border border-red-500 @enderror"
            name="{{ $name }}"
            value="{{ $value ?? $label }}"
            {{ ($checked ?? false) ? 'checked' : '' }}
            {{ $attributes }}
        />
    </div>
    <div class="text-gray-600">{{ $label }}</div>
</label>

@error($name)
    <x-form.error>
        {{ $message }}
    </x-form.error>
@enderror
