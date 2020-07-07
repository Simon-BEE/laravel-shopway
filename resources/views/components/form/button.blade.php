@props(['classDiv', 'class', 'type', 'disabled'])
<div class="{{ $classDiv ?? 'mt-4 flex justify-end' }}">
    <button
        type="{{ $type ?? 'submit' }}"
        class="flex items-center rounded text-white {{ $class ?? 'mr-3 p-2 bg-blue-600 hover:bg-blue-500' }} can-be-disabled"
        @isset($disabled) disabled @endisset
        {{ $attributes }}
    >
        {{ $slot }}
    </button>
</div>
