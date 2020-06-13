<div class="flex flex-col mb-6">
    <label class="inline-flex items-center text-sm text-gray-700" for="{{ $name }}">
        <input
            type="checkbox"
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-checkbox"
            {{ old($name) ? 'checked' : '' }}
            {{ $required ? 'required' : '' }}
        >
        <span class="ml-2">{{ __($label) }}</span>
    </label>

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
