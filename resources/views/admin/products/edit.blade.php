@extends('layouts.back')

@section('meta-title')
    Product edit: {{ $product->title }}
@endsection

@section('content')
<div class="flex justify-between">
    <h3 class="text-gray-700 text-3xl">Product edit: <span class="font-semibold">{{ $product->title }}</span></h3>
</div>

<div class="bg-white p-4 mt-6">

    <form action="#" method="post">
        @csrf
        <h4 class="font-semibold mb-3 text-lg">General informations about product</h4>
        <x-form.input
            label="Define a product's title"
            type="text"
            name="title"
            placeholder="Product's title"
            value="{{ old('title') ?? $product->title }}"
            helper="A slug will be generated automatically"
            required
        />
        <x-form.textarea
            label="Describe your product"
            name="description"
            placeholder="Product's description"
            value="{{ old('description') ?? $product->description }}"
            required
        />
        <h4 class="font-semibold my-3 text-lg">List of references</h4>
        @foreach ($product->references as $reference)
        <p class="font-semibold">{{ $reference->name }} <a href="#" class="ml-2 text-orange-500"><span class="mdi mdi-pencil text-xl"></span></a></p>
        @endforeach
    </form>
</div>
@endsection
