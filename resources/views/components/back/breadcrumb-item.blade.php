@props(['first', 'route', 'label', 'active', 'class', 'classActiv'])
<div class="">
    @isset($first)
    @else
    <span class="mx-2">&raquo;</span>
    @endisset
    <a href="{{ $route }}" class="hover:underline {{ $class ?? '' }} {{ ($active ?? false) ? ($classActiv ?? 'text-blue-500') : '' }}">{{ $label }}</a>
</div>