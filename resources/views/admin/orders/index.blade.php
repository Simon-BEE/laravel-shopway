@extends('layouts.back')

@section('meta-title')
    List of orders
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.orders.index') }}" label="List of orders" active/>
@endsection

@section('content')
    <x-modal title="Are you sure ?">
        <p>{{ __('Are you sure you want to delete this order?') }}</p>
        <div class="mt-5 flex justify-end">
            <x-form.button classDiv="none" class="p-2 mr-3 bg-gray-200 text-gray-700 hover:bg-gray-300" @click="isDialogOpen = false">{{ __('Cancel') }}</x-form.button>
            <x-form.form-button action="#" method="DELETE" class="p-2 rounded bg-red-500 text-white hover:bg-red-600" x-ref="modalDelete">
                {{ __('Delete this order') }}
            </x-form.form-button>
        </div>
    </x-modal>

    <livewire:admin.orders.index />
@endsection

@section('extra-js')
    <script>
        function setAction(event) {
            document.querySelector('.modal-element form').action = event.target.getAttribute('data-route');
        }
    </script>
@endsection
