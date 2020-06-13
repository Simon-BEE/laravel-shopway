<form method="POST" action="{{ $action }}" class="inline-block" {{ $attributes }}>
    @csrf
    @method($method ?? 'POST')
        <button
            type="submit"
            class="bg-gray-200 p-2 rounded inline-flex {{ $class ?? 'text-red-400 hover:text-red-600' }}"
        >
            {{ $slot }}
        </button>
</form>
