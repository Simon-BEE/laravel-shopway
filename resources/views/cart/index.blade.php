@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    Your cart
@endsection

@section('content')

<section class="my-12 min-h-full px-6 relative">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
        <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
            Cart
        </a>
    </div>
    <section class="flex justify-center my-6">
        <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg">
          <livewire:cart.index />
        </div>
    </section>
</section>


@endsection
