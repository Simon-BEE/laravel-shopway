<a href="{{ route('cart.index') }}" class="ml-3 rounded-full bg-gray-100 text-gray-700 text-xl text-center p-2 hover:bg-transparent hover:text-white transition-colors duration-200">
    <span class="mdi mdi-cart-outline relative">
        @if ($cartAmount > 0)
            <span class="absolute right-0 top-0 -mt-3 -mr-2 p-1 rounded-full text-xs text-white bg-blue-400">
                {{ $cartAmount }}
            </span>
        @endif
    </span>
</a>
