@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
{{ __('Your orders') }}
@endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('users.dashboard') }}" label="{{ __('Account') }}" />
    <x-breadcrumb-item route="{{ route('users.orders.index') }}" label="{{ __('Orders') }}" active />
@endsection

@section('content')

<section class="my-12 min-h-full px-6 py-10 relative">
    <div class="flex flex-col text-center w-full mb-20">
        <h2 class="text-2xl font-medium title-font mb-4 tracking-widest uppercase">{{ __('Your orders') }}</h2>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify, subway tile poke farm-to-table. Franzen you probably haven't heard of them.</p>
    </div>

    <section class="bg-white pb-4 px-4 rounded-md w-full">
        <div class="overflow-x-auto mt-6">
            <table class="table-auto border-collapse w-full">
                <thead>
                    <tr class="rounded-lg text-sm font-medium text-gray-700 text-left" style="font-size: 0.9674rem">
                        <th class="p-4 bg-gray-200">Order number</th>
                        <th class="p-4 bg-gray-200">Date</th>
                        <th class="p-4 bg-gray-200">Amount</th>
                        <th class="p-4 bg-gray-200"></th>
                    </tr>
                </thead>
                <tbody class="text-sm font-normal text-gray-700">
                    @foreach ($orders as $order)
                        <tr class="hover:bg-gray-100 border-b border-gray-200 py-10">
                            <td class="p-4 md:pl-12 font-bold">{{ $order->id }}</td>
                            <td class="p-4">{{ Format::date($order->created_at) }}</td>
                            <td class="p-4">{{ Format::priceWithCurrency($order->total) }}</td>
                            <td class="p-4">
                                <a href="{{ route('users.orders.show', $order) }}" class="p-2 rounded bg-blue-500 text-white hover:bg-blue-600">
                                    {{ __('Show details') }}
                                </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        {{ $orders->links() }}
    </section>
</section>


@endsection
