<div class="fixed right-0 top-0 mt-12 alert-flash transition-all duration-200 transform translate-x-full">
    <div class="p-2">
        <div class="inline-flex items-center bg-white leading-none {{ $type == 'success' ? 'text-green-500' : 'text-pink-600' }} rounded-full p-2 shadow text-teal text-sm">
            <span class="inline-flex {{ $type == 'success' ? 'bg-green-500' : 'bg-pink-600' }} text-white rounded-full pb-2 pt-1 px-3 justify-center items-center">
                {{ $type  }}
            </span>
            <span class="inline-flex px-2">
                {{ $slot }}
            </span>
        </div>
    </div>
</div>
