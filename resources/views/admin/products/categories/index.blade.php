@extends('layouts.back')

@section('meta-title')
    List of categories
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.products.categories.index') }}" label="List of categories" active/>
@endsection

@section('content')
    <x-modal title="Are you sure ?">
        <p>Are you sure you want to delete this category?</p>
        <div class="mt-5 flex justify-end">
            <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">Cancel</x-form.button>
            <x-form.form-button action="#" method="DELETE" class="p-2 rounded bg-red-500 text-white hover:bg-red-600" x-ref="modalDelete">
                Delete this category
            </x-form.form-button>
        </div>
    </x-modal>
    <x-modal title="Create a new category for products" modalName="formModalOpen">
        <form action="{{ route('admin.products.categories.store') }}" method="POST" id="modalForm">
            @csrf
            <x-form.input
                label="Define a category's name"
                type="text"
                name="name"
                placeholder="Category's name"
                value="{{ old('name') }}"
                helper="A slug will be generated automatically"
                required
            />
            <div class="mt-5 flex justify-end">
                <x-form.button type="button" classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" @click="formModalOpen = false">Cancel</x-form.button>
                <x-form.button classDiv="none" class="bg-blue-500 text-gray-200 hover:bg-blue-600">Create a new category</x-form.button>
            </div>
        </form>
    </x-modal>

    <livewire:admin.products.categories.index />
@endsection

@section('extra-js')
    <script>
        function setAction(event) {
            document.querySelector('.modal-element form').action = event.target.getAttribute('data-route');
        }
    </script>
@endsection
