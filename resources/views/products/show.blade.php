@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    {{ $product->title }}
@endsection

@section('content')

<section class="my-12 min-h-full px-6 py-10 relative">
    <div class="flex flex-col md:flex-row items-stretch justify-around">
        <div class="img w-full md:w-4/12">
            <img class="w-full h-full object-cover rounded shadow-lg" src="{{ $product->firstReference->imagePath }}" alt="lorem">
        </div>

        <div class="mt-4 md:mt-0 text-gray-700 w-full md:w-6/12 flex flex-col justify-between max-h-full">
            <div>
                <h3 class="text-xl mb-3 tracking-wider font-semibold">{{ $product->title }}</h3>
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
                <p class="text-right mt-4">
                    Other references :
                    @forelse ($product->references as $reference)
                        <span class="mr-1 text-xs text-white px-2 py-1 rounded bg-blue-400">{{ $reference->name }}</span>
                    @empty
                        <span>No references found.</span>
                    @endforelse
                </p>
            </div>
            <div class="mt-3 pt-6 border-t-2 border-gray-200 flex items-center justify-between">
                <div class="price text-3xl font-semibold text-gray-700">
                    <span class="price">{{ $product->firstReference->price }}</span><span class="text-gray-500 font-thin">€</span>
                </div>
                <div class="flex">
                    <a href="#" class="flex items-center p-2 rounded text-xl text-white mr-2 bg-blue-400 hover:bg-blue-600">
                        <span class="mdi mdi-cart-outline mr-2"></span>
                        Add to cart
                    </a>
                    <a href="#" class="rounded-full p-2 bg-gray-200 text-gray-500 hover:text-white hover:bg-red-500 transition-colors duration-200" @click.stop="alert('ok')">
                        <svg class="h-6 w-6 fill-current" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                            <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                        </svg>
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection
