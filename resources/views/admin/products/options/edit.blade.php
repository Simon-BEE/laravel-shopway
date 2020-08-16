@extends('layouts.back')

@section('meta-title')
    Product edit: {{ $product->name }}
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.products.index') }}" label="List of products"/>
    <x-back.breadcrumb-item route="{{ route('admin.products.edit', $product) }}" label="{{ $product->name }}"/>
    <x-back.breadcrumb-item route="{{ route('admin.products.options.edit', [$product, $productOption]) }}" label="{{ $productOption->id }}" active/>
@endsection

@section('content')
<x-modal title="Are you sure ?">
    <p>{{ __('Are you sure you want to delete this product?') }}</p>
    <div class="mt-5 flex justify-end">
        <x-form.button classDiv="none" class="p-3 mr-3 bg-gray-200 text-gray-700 hover:bg-gray-300" x-on:click="isDialogOpen = false">{{ __('Cancel') }}</x-form.button>
        <x-form.form-button action="{{ route('admin.products.options.destroy', [$product, $productOption]) }}" method="DELETE" class="p-3 rounded bg-red-500 text-white hover:bg-red-600">
            {{ __('Delete this product') }}
        </x-form.form-button>
    </div>
</x-modal>

<div class="flex flex-col md:flex-row relative">
    <h3 class="text-gray-700 text-3xl">Product edit: <span class="font-semibold">{{ $product->name }}</span> / Option: <span class="font-semibold">{{ $productOption->id }}</span></h3>
    <small class="md:ml-4 text-xs text-gray-700 flex items-center">
        <span class="mr-2 mdi mdi-information-outline text-orange-500 text-lg"></span>
        Each field has autosaving, be careful.
    </small>
    <div class="md:absolute top-0 right-0">
        <a href="{{ route('admin.products.options.create', $product) }}" class="p-3 mr-3 bg-blue-500 text-white hover:bg-blue-600 rounded">{{ __('Add a new option') }}</a>
    </div>
</div>

<livewire:admin.products.options.edit :product="$product" :productOption="$productOption"/>
@endsection

