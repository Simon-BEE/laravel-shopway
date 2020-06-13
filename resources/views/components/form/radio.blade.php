<label
    class="flex justify-start items-center text-truncate rounded-lg bg-white pl-4 pr-6 py-3 shadow-sm mr-4"
>
    <div class="mr-3">
        <input
            type="radio"
            class="form-radio focus:outline-none focus:shadow-outline @error($name) border border-red-500 @enderror"
            name="{{ $name }}"
            value="{{ $value ?? $label }}"
            {{ ($selected ?? false) ? 'selected' : '' }}
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
