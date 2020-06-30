@props(['action', 'class', 'method'])
<form method="POST" action="{{ $action }}" class="inline-block" {{ $attributes }}>
    @csrf
    @method($method ?? 'POST')
        <button
            type="submit"
            class="{{ $class ?? 'p-2 rounded inline-flex text-red-400 hover:text-red-600' }}"
        >
            {{ $slot }}
        </button>
</form>
