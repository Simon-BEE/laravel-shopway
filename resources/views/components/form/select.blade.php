@props(['label', 'name', 'multiple', 'required', 'helper'])
<div class="flex flex-wrap items-center mb-2">
    <label for="{{ $name }}" class=" text-gray-700 mb-2">
        {{ __($label) }}
    </label>
    <select
        class="{{ isset($multiple) ? 'h-32' : 'form-select' }} form-input w-full border-gray-200"
        name="{{ $name }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ isset($multiple) ? 'multiple' : '' }}
        {{ $attributes }}
    >
        {{ $slot }}
    </select>

    @if (isset($helper) && $helper)
        <x-form.helper>
            {{ $helper }}
        </x-form.helper>
    @endif

    @error($name)
        <x-form.error>
            {{ $message }}
        </x-form.error>
    @enderror
</div>
