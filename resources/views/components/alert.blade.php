<div class="fixed right-0 top-0 mt-20 max-w-lg z-40 alert-flash transition-all duration-200 transform translate-x-full">
    <div class="px-4 py-3">
        <div class="inline-flex items-center bg-white leading-none rounded px-3 py-5 shadow-lg border-l-4 text-teal text-sm {{ $type == 'success' ? 'text-green-500 border-green-500' : 'text-red-500 border-red-500' }}">
            <span class="inline-flex  rounded-full py-2 px-3 justify-center items-center">
                @if ($type == 'success')
                    <span class="mdi mdi-alert-circle-check-outline text-2xl"></span>
                @else
                    <span class="mdi mdi-alert-remove-outline text-2xl"></span>
                @endif
            </span>
            <p class="inline-flex px-2 leading-4 text-gray-700">
                {!! nl2br(e($slot)) !!}
            </p>
        </div>
    </div>
</div>
