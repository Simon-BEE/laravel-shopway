<section class="text-gray-700 my-10 flex flex-col-reverse md:flex-row justify-between">
    <section class="w-full md:w-2/3 mt-8 md:mt-0">
        <h2 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
            Payment information
        </h2>
        <div class="p-5 rounded shadow-md mt-5">
            <div class="">
                <h3 class="text-gray-600 font-semibold">{{ __('Your selected address') }}</h3>
                <article class="p-4 w-full rounded relative">
                    <div class="">
                        <h3 class="title-font font-medium text-lg text-gray-900">
                            {{ auth()->user()->address->name }} 
                            @if(auth()->user()->address->professionnal)<span class="text-xs text-gray-500 ml-1">{{ auth()->user()->address->company }}</span>@endif
                        </h3>
                        <h4 class="text-gray-500 mb-3 text-sm">{{ auth()->user()->address->city }}, {{ auth()->user()->address->country->name }}</h4>
                        <p class="mb-2">{{ auth()->user()->address->full_name }}</p>
                        <p class="mb-4">{{ auth()->user()->address->full_address }}</p>
                    </div>
                </article>
                <p class="text-sm text-gray-600 text-right">
                    <a href="{{ route('users.addresses.index') }}" class="text-blue-500 hover:underline">Choose another one</a>
                </p>
                <hr class="mt-5 mb-2">
            </div>
            <form id="payment-form" class="my-5">
                <h3 class="text-gray-600 font-semibold mb-4">{{ __('Payment details') }}</h3>
                <div id="card-element"><!--Stripe.js injects the Card Element--></div>
                <p id="card-error" role="alert" class="text-red-500 text-sm mt-3"></p>
                <div class="text-right">
                    <button id="submit" class="mt-8 inline-flex text-white bg-blue-500 border-0 py-3 px-6 focus:outline-none hover:bg-blue-600 rounded text-lg">
                        <div class="spinner hidden" id="spinner">
                            <x-spinner />
                        </div>
                        <span id="button-text" class="">{{ __('Pay') }} {{ $totalWithTaxAndShipping }}</span>
                    </button>
                </div>
            </form>
        </div>
    </section>
    <section class="w-full md:w-1/4">
        <h2 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
            Order summary
        </h2>
        <div class="p-2 rounded shadow-md mt-5 overflow-y-auto max-height-400">
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
        <div class="mt-5">
            <h2 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
                Shipping fees
            </h2>
            <article class="p-2 rounded shadow-md mt-5">
                <div class="w-full text-center relative">
                    <span class="font-semibold text-lg">
                        {{ $shippingFees }}
                    </span>
                </div>
            </article>
        </div>
        <div class="mt-5">
            <h2 class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl">
                Total to pay
            </h2>
            <article class="p-4 bg-gray-800 text-white rounded shadow-md mt-5">
                <div class="w-full text-center relative">
                    <span class="font-semibold text-lg">
                        {{ $totalWithTaxAndShipping }}
                    </span>
                </div>
            </article>
        </div>
    </section>
</section>