@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="{{ $product->excerpt }}"/>
@endsection

@section('meta-title') {{ $product->name }} @endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('products.index') }}" label="{{ __('Products') }}" />
    <x-breadcrumb-item route="{{ route('products.show', $product) }}" label="{{ $product->name }}" active />
@endsection

@section('content')

<section class="my-12 min-h-full px-6 py-10 relative">
    <livewire:products.show :product="$product" :sizes="$sizes" />
    <h3 class="mt-6 font-semibold text-lg text-gray-700">{{ __('All products pictures') }}</h3>
    <div class="mt-4 grid md:grid-cols-4 gap-4">
        @forelse ($product->images as $image)
            <a href="{{ $product->imagePath($image->filename) }}" class="transition-transform duration-700 transform hover:scale-105">
                <img class="w-full h-full object-cover rounded shadow-lg" src="{{ $product->imagePath($image->filename) }}" alt="{{ $product->name }}">
            </a>
        @empty
            No pictures found.
        @endforelse
    </div>
</section>


@endsection
