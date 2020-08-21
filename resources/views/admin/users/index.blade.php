@extends('layouts.back')

@section('meta-title')
    List of users
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.users.index') }}" label="List of users" active/>
@endsection

@section('content')
    <x-modal title="Are you sure ?">
        <p>{{ __('Are you sure you want to delete this user?') }}</p>
        <div class="mt-5 flex justify-end">
            <x-form.button classDiv="none" class="p-2 mr-3 bg-gray-200 text-gray-700 hover:bg-gray-300" x-on:click="isDialogOpen = false">{{ __('Cancel') }}</x-form.button>
            <x-form.form-button action="#" method="DELETE" class="p-2 rounded bg-red-500 text-white hover:bg-red-600" x-ref="modalDelete">
                {{ __('Delete this user') }}
            </x-form.form-button>
        </div>
    </x-modal>
    <div class="flex justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">List of users</h3>
        <div class="flex">
            <a href="#" class="flex items-center mr-3 p-2 rounded text-white bg-blue-600 hover:bg-blue-500">
                <span class="mdi mdi-plus mr-2"></span>
                Add a user
            </a>
        </div>
    </div>

    <livewire:admin.users.index />
@endsection

@section('extra-js')
    <script>
        function setAction(event) {
            document.querySelector('.modal-element form').action = event.currentTarget.getAttribute('data-route');
        }
    </script>
@endsection
