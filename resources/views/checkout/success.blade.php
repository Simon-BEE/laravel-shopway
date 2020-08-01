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
    <article class="w-3/5 mt-12 px-16 pb-16 bg-green-200 text-green-900 rounded border-b-4 border-green-900">
        <div class="-mt-6 p-6 rounded bg-white mb-16 text-center font-semibold">
            {{ _('Congrats, your order has been recorded !') }}
        </div>
        Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem similique neque cumque, magnam reiciendis consequuntur labore minima quasi laudantium, earum saepe vel sint ex totam quidem voluptate, dignissimos eum odit.

        <p class="flex justify-between mt-16">
            <a href="#" class="font-semibold hover:underline">&rarr; Download your invoice</a>
            <a href="#" class="font-semibold hover:underline">&rarr; Check your receipt</a>
            <a href="#" class="font-semibold hover:underline">&rarr; Back to homepage</a>
        </p>
    </article>
</section>

@endsection