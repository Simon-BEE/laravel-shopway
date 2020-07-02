@extends('layouts.back')

@section('meta-title')
    Create a product
@endsection

@section('content')

    <div class="flex justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">Create a product</h3>
    </div>
    <div class="mt-6 p-4 bg-white">
        <form action="{{ route('admin.products.store') }}" method="post" class="productForm">
            @csrf
            <x-form.input
                label="Define a product's name"
                type="text"
                name="name"
                placeholder="Product's name"
                value="{{ old('name') }}"
                helper="A slug will be generated automatically"
                required
            />
            <x-form.textarea
                label="Describe your product"
                name="description"
                placeholder="Product's description"
                value="{{ old('description') }}"
                required
            />

            <div class="mt-6">
                <hr>
                <x-form.button>
                    Create a product
                </x-form.button>
            </div>
        </form>
    </div>
@endsection
