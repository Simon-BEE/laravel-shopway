@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="{{ $product->excerpt }}"/>
@endsection

@section('meta-title') {{ $product->name }} @endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('products.index') }}" label="{{ __('Products') }}" />
    <x-breadcrumb-item route="{{ route('products.show', $product) }}" label="{{ $product->name }}" active />
@endsection

@section('content')

<section class="my-12 min-h-full px-6 py-10 relative">
    <div class="flex flex-col md:flex-row items-stretch justify-between">
        <div class="img w-full md:w-4/12">
            <img class="w-full h-full object-cover rounded shadow-lg" src="{{ $product->mainImagePath }}" alt="{{ $product->name }}">
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
            </div>
            <div class="mt-3 pt-6 border-t-2 border-gray-200 flex items-center justify-between">
                <div class="price text-3xl font-semibold text-gray-700">
                    {{ Format::priceWithTaxAndCurrency($product->price) }}
                </div>
                <div class="flex">
                    <livewire:cart.add :product="$product" :slot="'button'" />
                    <livewire:wish.toggle :product="$product" :key="$product->id" />
                </div>
            </div>
        </div>
    </div>
    <h3 class="mt-6 font-semibold text-lg text-gray-700">{{ __('All products pictures') }}</h3>
    <div class="mt-4 grid md:grid-cols-4 gap-4">
        @forelse ($product->images as $image)
            <a href="{{ $product->imagePath($image->filename) }}" class="transition-transform duration-700 transform hover:scale-105">
                <img class="w-full h-full object-cover rounded shadow-lg" src="{{ $product->imagePath($image->filename) }}" alt="{{ $product->name }}">
            </a>
        @empty
            No pictures found.
        @endforelse
    </div>
</section>


@endsection
