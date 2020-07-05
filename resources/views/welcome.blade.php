@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    Welcome
@endsection

@section('modal')
<x-modal>
    <x-product.content-modal />
</x-modal>
@endsection

@section('content')

    <x-includes.hero />

    <section class="bg-white py-6">
        <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
            <nav id="store" class="w-full z-30 top-0 px-6 py-1" x-data="{search : false}">
                <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                    <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                        Store
                    </a>
                </div>
            </nav>
            @forelse ($products as $product)
            <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
                <div class="cursor-pointer"
                    @click="
                        isDialogOpen = true;
                        $refs.productModalRoute.href='{{ route('products.show', $product) }}';
                        $refs.productModalTitle.innerText='{{ ucfirst($product->name) }}';
                        $refs.productModalDesc.innerText='{{ $product->excerpt }}';
                        $refs.productModalPrice.innerText='{{ Format::priceWithTaxAndCurrency($product->price) }}';
                        $refs.productModalImg.src='{{ $product->mainImagePath }}';
                        $refs.productModalId.setAttribute('data-product', {{ $product->id }});
                ">
                    <livewire:products.card :product="$product" :key="$product->id" />
                </div>
            </div>
            @empty
            <p>Sorry, no products can be displayed for the moment!</p>
            @endforelse
        </div>
    </section>

    <x-includes.newsletter />
@endsection

@section('extra-js')
<script>
    window.onload = () => {
        window.livewire.on('addToCart', () => {
            let modalProductElement = document.querySelector('.modal-product');
            window.livewire.emit('addToCartFromModal', modalProductElement.getAttribute('data-product'));
        });
        window.livewire.on('addToWishlist', () => {
            let modalProductElement = document.querySelector('.modal-product');
            window.livewire.emit('addToWishlistFromModal', modalProductElement.getAttribute('data-product'));
        });
    }
</script>
@endsection
