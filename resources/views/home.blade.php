@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    Your account
@endsection

@section('content')

<section class="my-12 max-h-full border border-gray-200 shadow-inner rounded-lg px-6 py-10 relative">
    <article class="my-4 absolute left-0 top-0 ml-4">
        <h2 class="text-xl font-semibold text-gray-600">{{ __('Welcome') }} <span class="font-normal">{{ auth()->user()->firstname ?? auth()->user()->email }}</span></h2>
    </article>
    <article class="my-4 absolute right-0 top-0 mr-2">
        <x-form.form-button action="{{ route('logout') }}" class="bg-red-400 text-white hover:bg-red-600">
            <span class="mdi mdi-logout mr-2"></span>
            {{ __('Logout') }}
        </x-form.form-button>
    </article>
    <section class="pt-16 pb-12 grid md:grid-cols-3 col-gap-8 row-gap-12">
        <a href="#" class="rounded-lg p-6 shadow-md bg-white flex flex-col items-center justify-center transition-transform duration-300 transform hover:scale-105">
            <span class="text-6xl text-blue-500 mdi mdi-archive-outline"></span>
            <h2 class="text-blue-500 text-lg tracking-wider">{{ __('Orders') }}</h2>
        </a>
        <a href="#" class="rounded-lg p-6 shadow-md bg-white flex flex-col items-center justify-center transition-transform duration-300 transform hover:scale-105">
            <span class="text-6xl text-blue-500 mdi mdi-map-search-outline"></span>
            <h2 class="text-blue-500 text-lg tracking-wider">{{ __('Addresses') }}</h2>
        </a>
        <a href="#" class="rounded-lg p-6 shadow-md bg-white flex flex-col items-center justify-center transition-transform duration-300 transform hover:scale-105">
            <span class="text-6xl text-blue-500 mdi mdi-account-cog-outline"></span>
            <h2 class="text-blue-500 text-lg tracking-wider">{{ __('Account') }}</h2>
        </a>
        {{--  --}}
        <a href="#" class="rounded-lg p-6 shadow-md bg-white flex flex-col items-center justify-center transition-transform duration-300 transform hover:scale-105">
            <span class="text-6xl text-blue-500 mdi mdi-heart-outline"></span>
            <h2 class="text-blue-500 text-lg tracking-wider">{{ __('Wishlist') }}</h2>
        </a>
        <a href="#" class="rounded-lg p-6 shadow-md bg-white flex flex-col items-center justify-center transition-transform duration-300 transform hover:scale-105">
            <span class="text-6xl text-blue-500 mdi mdi-credit-card-outline"></span>
            <h2 class="text-blue-500 text-lg tracking-wider">{{ __('Payments') }}</h2>
        </a>
        <a href="#" class="rounded-lg p-6 shadow-md bg-white flex flex-col items-center justify-center transition-transform duration-300 transform hover:scale-105">
            <span class="text-6xl text-blue-500 mdi mdi-help-circle-outline"></span>
            <h2 class="text-blue-500 text-lg tracking-wider">{{ __('Help') }}</h2>
        </a>
    </section>
</section>


@endsection
