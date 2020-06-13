<div class="flex flex-wrap mb-4">
    <label for="{{ $name }}" class="block text-gray-700 text-sm font-bold mb-2">
        {{ __($label) }}
    </label>

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-input w-full h-40 text-gray-600 @error($name) border-red-500 @enderror"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >
        {{ old($name) ?? ((isset($property) && $property) ? $property : '') }}
    </textarea>

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
