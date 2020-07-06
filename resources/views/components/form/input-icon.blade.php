@props(['classDiv', 'class', 'type', 'label', 'placeholder', 'name', 'value', 'required', 'helper', 'icon'])
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

    <div class="relative inline-block w-full">
        <input
            type="{{ $type ?? 'text' }}"
            name="{{ $name }}"
            id="{{ $name }}"
            class="form-input w-full border-gray-200 {{ !empty($iconRight) ? 'pr-10' : 'pl-10' }} @error($name) border-red-500 @enderror"
            placeholder="{{ $placeholder ?? '' }}"
            value="{{ isset($value) ? $value : '' }}"
            {{ ($required ?? false) ? 'required' : '' }}
            {{ $attributes }}
        >
        <div class="pointer-events-none absolute inset-y-0 {{ !empty($iconRight) ? 'right-0 pr-3' : 'left-0 pl-3' }} flex items-center ">
          <span class="mdi {{ $icon }} text-gray-500"></span>
        </div>
    </div>

    @isset($helper)
        <x-form.helper>
            {{ $helper }}
        </x-form.helper>
    @endisset

    @error($name)
        <x-form.error>
            {{ $message }}
        </x-form.error>
    @enderror
</div>
