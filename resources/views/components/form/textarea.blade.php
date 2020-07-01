@props(['classDiv', 'class', 'label', 'placeholder', 'name', 'value', 'required', 'helper'])
<div class="flex flex-wrap mb-4">
    @if($label ?? null)
    <div class="flex justify-between w-full items-center mb-2">
        <label class="label {{ ($required ?? false) ? 'label-required' : '' }} text-gray-700" for="{{ $name }}">
            {{ $label }}
        </label>
        @if(empty($required))
            <small class="text-xs text-gray-500">(Optionnal)</small>
        @endif
    </div>
    @endif

    <textarea
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-input w-full h-40 text-gray-600 border-gray-200 @error($name) border-red-500 @enderror"
        placeholder="{{ $placeholder }}"
        {{ $required ? 'required' : '' }}
        {{ $attributes }}
    >{{ isset($value) ? $value : '' }}</textarea>

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
