@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    {{ __('Order can\'t be validated') }}
@endsection

@section('breadcrumb')
@endsection

@section('content')

<section class="text-gray-700 my-10 min-h-full flex flex-col items-center justify-between">
    <article class="w-3/5 mt-12 pb-16 bg-red-200 text-red-900 rounded border-b-4 border-red-900">
        <div class="p-6 w-full rounded-t bg-red-900 text-white  mb-16 text-center font-semibold">
            {{ _('Your order has not been validated !') }}
        </div>
        <div class="px-16">
            Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem similique neque cumque, magnam reiciendis consequuntur labore minima quasi laudantium, earum saepe vel sint ex totam quidem voluptate, dignissimos eum odit.
    
            <p class="flex justify-between mt-16">
                <a href="#" class="font-semibold hover:underline">&rarr; Back to checkout page</a>
                <a href="#" class="font-semibold hover:underline">&rarr; Back to homepage</a>
            </p>
        </div>
    </article>
</section>

@endsection