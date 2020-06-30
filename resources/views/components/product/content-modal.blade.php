

<div class="flex flex-col md:flex-row items-stretch justify-around modal-product" data-product="" x-ref="productModalId">
    <div class="img w-full md:w-4/12">
        <img class="w-full h-full object-cover rounded shadow-lg" x-ref="productModalImg" src="" alt="lorem">
    </div>

    <div class="mt-4 md:mt-0 text-gray-700 w-full md:w-6/12 flex flex-col justify-between max-h-full">
        <div class="flex flex-col">
            <h3 class="text-xl mb-3 tracking-wider font-semibold" x-ref="productModalTitle">
                {{-- Dynamic Content Here --}}
            </h3>
            <div class="text-sm mb-5">
                <span class="flex items-center">
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-blue-400" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-blue-400" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-blue-400" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <svg fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-blue-400" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <svg fill="none" stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" class="w-4 h-4 text-blue-400" viewBox="0 0 24 24">
                        <path d="M12 2l3.09 6.26L22 9.27l-5 4.87 1.18 6.88L12 17.77l-6.18 3.25L7 14.14 2 9.27l6.91-1.01L12 2z"></path>
                    </svg>
                    <span class="text-gray-600 ml-3">4 Reviews</span>
                </span>
            </div>
            <p class="text-justify leading-5" x-ref="productModalDesc">
                {{-- Dynamic Content Here --}}
            </p>
            <a href="#" class="link p-2 text-blue-400 hover:underline ml-auto mt-4" x-ref="productModalRoute">Show details...</a>
        </div>
        <div class="mt-3 pt-6 border-t-2 border-gray-200 flex items-center justify-between">
            <div class="price text-3xl font-semibold text-gray-700"><span class="price" x-ref="productModalPrice">
                {{-- Dynamic Content Here --}}
            </div>
            <div class="flex">
                <livewire:cart.add-from-modal />
            </div>
        </div>
    </div>
</div>

