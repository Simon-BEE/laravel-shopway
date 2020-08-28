<div class="flex flex-col md:flex-row items-stretch justify-between">
    <div class="img w-full md:w-4/12">
        <img class="w-full h-full object-cover rounded shadow-lg" src="{{ $selectedProduct->mainImagePath }}" alt="{{ $product->name }}">
    </div>

    <div class="mt-4 md:mt-0 text-gray-700 w-full md:w-6/12 flex flex-col justify-between max-h-full">
        <div>
            <h3 class="text-xl mb-3 tracking-wider font-semibold">{{ $product->name }}</h3>
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
            <p class="text-justify leading-5">{{ $product->description }}</p>
            <div class="my-6">
                <h4 class="font-semibold">{{ __('Sizes avalaible') }}</h4>
                <ul class="flex flex-wrap mt-2">
                    @foreach ($sizes as $size)
                        <li 
                            class="p-2 mr-1 mb-1 border {{ $selectedProduct->hasSize($size->id) && $selectedProduct->whereSizeIs($size->id)->is_avalaible ? 'hover:bg-gray-200 cursor-pointer' : 'bg-gray-300 text-white' }} {{ $selectedSize->id === $size->id ? 'border-solid border-blue-500 cursor-text' : 'border-dashed' }}"
                            wire:click="selectSizeOption({{ $size->id }})"
                        >
                            {{ $size->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
            <div class="my-6">
                <h4 class="font-semibold">Colors</h4>
                <ul class="flex flex-wrap mt-2">
                    @foreach ($product->product_options as $productOption)
                        <li 
                            class="p-2 mr-1 mb-1 border {{ $productOption->id === $selectedProduct->id ? $productOption->classname : 'hover:bg-gray-100 cursor-pointer' }}"
                            wire:click="selectOption({{ $productOption->id }})"
                        >
                            {{ $productOption->color->name }} / {{ $productOption->material->name }}
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>
        <div class="mt-3 pt-6 border-t-2 border-gray-200 flex items-center justify-between">
            <div class="price text-3xl font-semibold text-gray-700">
                {{ Format::priceWithTaxAndCurrency($selectedProduct->price) }}
            </div>
            <div class="flex">
                <button type="button" class="flex items-center p-2 rounded text-xl text-white mr-2 bg-blue-400 hover:bg-blue-600" wire:click="addToCart">
                    <span class="mdi mdi-cart-outline mr-2"></span>
                    {{ __('Add to cart') }}
                </button>
                
                <livewire:wish.toggle :product="$product" :key="$product->id" />
            </div>
        </div>
    </div>
</div>