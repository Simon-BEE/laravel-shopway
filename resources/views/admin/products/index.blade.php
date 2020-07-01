@extends('layouts.back')

@section('meta-title')
    List of products
@endsection

@section('content')
    <x-modal title="Are you sure ?">
        <p>Are you sure you want to delete this product and its references?</p>
        <div class="mt-5 flex justify-end">
            <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">Cancel</x-form.button>
            <x-form.form-button action="#" method="DELETE" class="p-2 rounded bg-red-500 text-white hover:bg-red-600" x-ref="modalUser">
                Delete this product
            </x-form.form-button>
        </div>
    </x-modal>
    <div class="flex justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">List of products</h3>
        <div class="flex">
            <a href="{{ route('admin.products.create') }}" class="flex items-center mr-3 p-2 rounded text-white bg-blue-600 hover:bg-blue-500">
                <span class="mdi mdi-plus mr-2"></span>
                Create a product
            </a>
            <a href="{{ route('admin.products.create') }}" class="flex items-center p-2 rounded text-white bg-orange-500 hover:bg-orange-600">
                <span class="mdi mdi-plus mr-2"></span>
                Add a new reference
            </a>
        </div>
    </div>

    <livewire:admin.products.index />
@endsection
