@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    {{ __('Checkout') }}
@endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('cart.index') }}" label="{{ __('Cart') }}" />
    <x-breadcrumb-item route="{{ route('checkout.index') }}" label="{{ __('Checkout') }}" active />
@endsection

@section('content')

<section class="text-gray-700 my-10 flex flex-col md:flex-row justify-between">
    <section class="w-full md:w-2/3">
        <h2 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
            Payment information
        </h2>
        <div class="p-5 rounded shadow-md mt-5">
            <form id="payment-form">
                <div id="card-element"></div>
            </form>
        </div>
    </section>
    <section class="w-full md:w-1/4">
        <h2 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
            Order summary
        </h2>
        <div class="p-2 rounded shadow-md mt-5">
            @foreach ($cartProducts as $productId => $product)
                <article class="w-full p-5 relative flex items-center mb-3">
                    <div class="img w-5/12">
                        <img src="{{ $product['photo'] }}" alt="{{ $product['name'] }}" class="object-cover rounded-lg" style="width:110px;height:110px">
                    </div>
                    <div class="ml-2 flex flex-col justify-between h-20">
                        <div class="flex flex-col">
                            <a href="#">{{ $product['name'] }}</a>
                            <span class="text-gray-500 text-xs">Quantity: {{ $product['quantity'] }}</span>
                        </div>
                        <span class="font-semibold text-lg">
                            {{ Format::priceWithTaxAndCurrency($product['price']) }}
                        </span>
                    </div>
                    <div class="absolute top-0 right-0 mr-1 mt-1">
                        <x-form.form-button action="#" method="DELETE" wire:submit.prevent="removeFromCart({{ $productId }})">
                            <span class="mdi mdi-delete ml-2 text-xs"></span>
                        </x-form.form-button>
                    </div>
                </article>
            @endforeach
        </div>
    </section>
</section>

@endsection

@section('extra-js')
    <script src="https://js.stripe.com/v3/"></script>
@endsection