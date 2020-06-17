<div class="{{ $classDiv ?? 'flex flex-wrap mb-4' }}">
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
    <input
        type="{{ $type ?? 'text' }}"
        name="{{ $name }}"
        id="{{ $name }}"
        class="form-input w-full border-gray-200 @error($name) border-red-500 @enderror"
        placeholder="{{ $placeholder ?? '' }}"
        value="{{ isset($value) ? $value : '' }}"
        {{ ($required ?? false) ? 'required' : '' }}
        {{ $attributes }}
    >

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
