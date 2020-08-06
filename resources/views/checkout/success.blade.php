@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    {{ __('Order is confirmed') }}
@endsection

@section('breadcrumb')
@endsection

@section('content')

<section class="text-gray-700 my-10 min-h-full flex flex-col items-center justify-between">
    <article class="w-3/5 mt-12 pb-16 bg-gray-100 text-green-900 rounded border-b-4 border-green-600">
        <div class="p-6 w-full rounded-t bg-green-600 text-white  mb-16 text-center font-semibold">
            {{ _('Congrats, your order has been recorded !') }}
        </div>
        <div class="px-16">
            <h3 class="text-center text-4xl font-semibold mb-6">
                Order n°{{ $order->id }}
            </h3>
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem similique neque cumque, magnam reiciendis consequuntur labore minima quasi laudantium, earum saepe vel sint ex totam quidem voluptate, dignissimos eum odit.
    
            <p class="flex justify-between mt-16">
                <a href="#" class="font-semibold text-green-600 hover:underline">&rarr; Download your invoice</a>
                <a href="{{ route('users.orders.show', $order) }}" class="font-semibold text-green-600 hover:underline">&rarr; Check your order</a>
                <a href="{{ route('welcome') }}" class="font-semibold text-green-600 hover:underline">&rarr; Back to homepage</a>
            </p>
        </div>
    </article>
</section>

@endsection