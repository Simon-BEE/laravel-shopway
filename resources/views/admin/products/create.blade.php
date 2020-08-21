@extends('layouts.back')

@section('meta-title')
    Create a product
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.products.index') }}" label="List of products"/>
    <x-back.breadcrumb-item route="{{ route('admin.products.create') }}" label="Create a product" active/>
@endsection

@section('content')

    <div class="flex justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">Create a product</h3>
    </div>
    <div class="mt-6 p-4 bg-white">
        <form action="{{ route('admin.products.store') }}" method="post" class="productForm" enctype="multipart/form-data">
            @csrf
            <h4 class="text-lg font-semibold mb-3">Informations</h4>

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
            <x-form.select 
                label="Choose a product's category"
                name="categories[]"
                required
                multiple
            >
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </x-form.select>
            
            

            <div class="mt-6">
                <x-form.button>
                    {{ __('Create a product and add an option') }}
                </x-form.button>
            </div>
        </form>
    </div>
@endsection
