<div class="flex flex-wrap items-center mb-2">
    <label for="{{ $name }}" class=" text-gray-700 mb-2">
        {{ __($label) }}
    </label>
    <select
        class="{{ isset($multiple) ? 'h-32' : 'form-select' }} w-full border border-gray-200 bg-white text-gray-500 sm:text-sm sm:leading-5"
        name="{{ $name }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ isset($multiple) ? 'multiple' : '' }}
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
