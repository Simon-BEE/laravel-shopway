@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    {{ __('Your wishlist') }}
@endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('users.dashboard') }}" label="{{ __('Account') }}" />
    <x-breadcrumb-item route="{{ route('users.wish.index') }}" label="{{ __('Wishlist') }}" active />
@endsection

@section('content')

<section class="text-gray-700 mt-5 relative">
    <article class="mt-4 mb-6 flex items-end">
        <h2 class="text-xl font-semibold text-gray-600">{{ __('Your wishlist') }}</h2>
    </article>
    <livewire:wish.index />
</section>

@endsection
