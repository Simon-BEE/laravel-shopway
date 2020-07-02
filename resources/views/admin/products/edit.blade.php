@extends('layouts.back')

@section('meta-title')
    Product edit: {{ $product->name }}
@endsection

@section('content')
<div class="flex justify-between">
    <h3 class="text-gray-700 text-3xl">Product edit: <span class="font-semibold">{{ $product->name }}</span></h3>
</div>

<div class="bg-white p-4 mt-6">

    <form action="#" method="post">
        @csrf
        <h4 class="font-semibold mb-3 text-lg">General informations about product</h4>
        <x-form.input
            label="Define a product's name"
            type="text"
            name="name"
            placeholder="Product's name"
            value="{{ old('name') ?? $product->name }}"
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
    </form>
</div>
@endsection
