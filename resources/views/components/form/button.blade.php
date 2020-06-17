<div class="{{ $classDiv ?? 'mt-4 flex justify-end' }}">
    <button
        type="submit"
        class="flex items-center mr-3 p-2 rounded text-white {{ $class ?? 'bg-blue-600 hover:bg-blue-500' }}"
        {{ $attributes }}
    >
        {{ $slot }}
    </button>
</div>
