@props(['action', 'class', 'method'])
<form method="POST" action="{{ $action }}" class="inline-block" {{ $attributes }}>
    @csrf
    @method($method ?? 'POST')
    {{ $slot }}
</form>
