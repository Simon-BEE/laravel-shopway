@props(['first', 'route', 'label', 'active', 'class', 'classActiv'])
<div class="">
    @isset($first)
    @else
    <span class="mx-2 text-white">&raquo;</span>
    @endisset
    <a href="{{ $route }}" class="text-white hover:underline {{ ($active ?? false) ? 'text-blue-200' : '' }}">{{ $label }}</a>
</div>