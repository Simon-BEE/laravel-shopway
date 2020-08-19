@extends('layouts.back')

@section('meta-title')
    {{ __('Order n°') . $order->id }}
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.orders.index') }}" label="List of orders"/>
    <x-back.breadcrumb-item route="{{ route('admin.orders.show', $order) }}" label="{{ __('Order n°') . $order->id }}" active/>
@endsection

@section('content')
<section class="mb-12 min-h-full px-6 py-10 relative bg-white">
    <div class="absolute top-0 right-0 mr-2 mt-2">
        <a href="#" class="bg-white p-2 rounded inline-flex text-orange-400 hover:text-orange-600 hover:bg-gray-100 mr-2">
            <span class="text-lg mdi mdi-pencil-outline"></span>
        </a>
        <button type="button" class="bg-white p-2 rounded inline-flex text-red-400 hover:text-red-600 hover:bg-gray-100">
            <span class="text-lg mdi mdi-delete-outline" data-route="#" x-on:click="setAction($event); isDialogOpen = true;"></span>
        </button>
    </div>
    <div class="flex flex-col text-center w-full mb-10 md:mb-20">
        <h2 class="text-2xl font-medium title-font mb-4 tracking-widest uppercase">
            {{ __('Order n°') . $order->id }}
            <span class="text-gray-500">({{ Format::date($order->created_at) }})</span>
        </h2>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
            Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify, subway tile poke farm-to-table. Franzen you probably haven't heard of them.
        </p>
    </div>

    <article class="text-right mb-6 md:mb-0 flex justify-end items-center">
        <a href="{{ route('admin.users.show', $order->user) }}" class="text-blue-500 hover:underline inline-flex items-center mr-3">
            <span class="mdi mdi-account-arrow-right mr-2 text-xl"></span>
            {{ __('Show customer') }}
        </a>
        <a href="#" class="text-blue-500 hover:underline inline-flex items-center">
            <span class="mdi mdi-file-download-outline mr-2 text-xl"></span>
            {{ __('Download invoice') }}
        </a>
    </article>

    <section class="flex flex-col">
        <article class="flex flex-col pl-3 border-l-2 border-gray-700 w-full pb-3">
            <h3 class="text-xl tracking-widest font-semibold text-gray-700 mb-4">{{ __('Products details') }}</h3>
            <div class="mt-2">
                @forelse ($order->order_items as $item)
                    <div class="p-3 mb-2 bg-gray-200 flex flex-col md:flex-row items-center md:justify-between">
                        <p>
                            @if ($item->product_option)
                                <a href="{{ route('products.show', $item->product_option->product) }}" class="text-blue-500 hover:underline">{{ $item->product_option->product->name }}</a>
                            @else
                                {{ $item->name }}
                            @endif
                            <span class="text-gray-700 text-sm">
                                ({{ __('Size') }}: {{ Option::size($item->size_id) }}) / 
                                ({{ $item->product_option->color->name }}/{{ $item->product_option->material->name }})
                            </span>
                        </p>
                        <p class="mt-2 md:mt-0">
                            <span class="text-sm text-gray-600">
                                Quantity: {{ $item->quantity }}
                            </span>
                            <span class="md:ml-3">
                                Price: <span class="font-semibold">{{ Format::priceWithTaxAndCurrency($item->price) }}</span>
                            </span>
                        </p>
                    </div>
                @empty
                    <p class="flex items-center">
                        <span class="mdi mdi-alert-outline text-red-500 font-semibold text-xl mr-3"></span>
                        {{ __('Unable to get your product items. Sorry for that, problem will be resolve very soon. Thanks for your patience.') }}
                    </p>
                @endforelse
            </div>
        </article>
        <div class="flex flex-col md:flex-row justify-between md:my-8">
            <article class="my-6 md:my-0 flex flex-col pl-3 border-l-2 border-gray-700 w-full md:w-1/3 pb-3">
                <h3 class="text-xl tracking-widest font-semibold text-gray-700 mb-4">{{ __('Billing details') }}</h3>
                @if ($order->address)
                <div class="mt-2">
                    <div class="space-y-6">
                        <h3 class="title-font font-medium text-lg text-gray-900 flex items-center uppercase">
                            <span class="mdi mdi-account-details-outline text-gray-600 text-xl font-semibold mr-6" title="User name"></span>
                            {{ $order->address->full_name }}
                            <span class="text-xs text-gray-500 ml-1 normal-case">({{ $order->address->city }}, {{ $order->address->country->name }})</span>
                            @if($order->address->professionnal)
                                <span class="text-xs text-gray-500 ml-1 normal-case">{{ $order->address->company }}</span>
                            @endif
                        </h3>
                        <p class="flex items-center">
                            <span class="mdi mdi-home-city-outline text-gray-600 text-xl font-semibold mr-6" title="address"></span>
                            {{ $order->address->full_address }}
                        </p>
                        <p class="flex items-center">
                            <span class="mdi mdi-cellphone-iphone text-gray-600 text-xl font-semibold mr-6" title="phone number"></span>
                            {{ $order->address->phone }}
                        </p>
                        @if ($order->address->deleted_at)
                            <p class="text-red-500">&rarr; {{ __('Address deleted at') }}: {{ Format::date($order->address->deleted_at) }}</p>
                        @endif
                    </div>
                </div>
                @else
                    <p class="text-red-500">{{ __('Address not found') }}</p>
                @endif
            </article>
            <article class="flex flex-col pl-3 border-l-2 border-gray-700 w-full md:w-5/12 pb-3">
                <h3 class="text-xl tracking-widest font-semibold text-gray-700 mb-4">{{ __('Shipping details') }}</h3>
                <div class="space-y-6">
                    <p class="mt-2">
                        <span class="font-semibold text-{{ $order->state->color }}-500 rounded-lg p-2 bg-gray-100">{{ $order->state->name }}</span>
                    </p>
                    <p class="flex items-center">
                        <span class="mdi mdi-cash-marker text-gray-600 font-semibold text-xl mr-3"></span>
                        {{ __('Shipping fees') }}: <span class="font-semibold ml-1">{{ Format::priceWithCurrency($order->shipping_amount) }}</span>
                    </p>
                    <p class="flex items-center">
                        <span class="mdi mdi-domain text-gray-600 font-semibold text-xl mr-3"></span>
                        {{ __('Shipping company') }}: <span class="font-semibold ml-1">{{ $order->shipping_company }}</span>
                    </p>
                    <p class="flex items-center">
                        @if ($order->order_items->isNotEmpty())
                            <span class="mdi mdi-truck text-gray-600 font-semibold text-xl mr-3"></span>
                            {{ __('Tracking number') }}: <span class="font-semibold ml-1">{{ $order->reference }}</span>
                        @else
                            <span class="mdi mdi-alert-outline text-red-500 font-semibold text-xl mr-3"></span>
                            {{ __('Unable to get. Sorry for that, problem will be resolve very soon. Thanks for your patience.') }}
                        @endif
                    </p>
                </div>
            </article>
        </div>
        <article class="flex flex-col pl-3 border-l-2 border-gray-700 w-full pb-3 mt-8 md:mt-0">
            <h3 class="text-xl tracking-widest font-semibold text-gray-700 mb-4">{{ __('Total') }}</h3>
            <ul class="space-y-4 text-center">
                <li class="px-2 py-3 bg-gray-200">
                    <span class="text-gray-600 mr-2">{{ __('Shipping fees') }}:</span>
                    <span class="font-semibold">{{ Format::priceWithCurrency($order->shipping_amount) }}</span>
                </li>
                <li class="px-2 py-3 bg-gray-200">
                    <span class="text-gray-600 mr-2">{{ __('Price without taxes') }}:</span>
                    <span class="font-semibold">{{ Format::priceWithoutTaxAndWithCurrency($order->price) }}</span>
                </li>
                <li class="px-2 py-3 bg-gray-200">
                    <span class="text-gray-600 mr-2">{{ __('Price with taxes') }}:</span>
                    <span class="font-semibold">{{ Format::priceWithCurrency($order->price) }}</span>
                </li>
                <li class="px-2 py-3 bg-gray-800 text-gray-100">
                    <span class="mr-2">{{ __('Total price with taxes and shipping fees') }}:</span>
                    <span class="font-semibold">{{ Format::priceWithCurrency($order->total) }}</span>
                </li>
            </ul>
        </article>
    </section>
</section>

@endsection
