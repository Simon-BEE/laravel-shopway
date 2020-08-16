@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
{{ __('Your addresses') }}
@endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('users.dashboard') }}" label="{{ __('Account') }}" />
    <x-breadcrumb-item route="{{ route('users.addresses.index') }}" label="{{ __('Addresses') }}" active />
@endsection

@section('content')
<x-modal title="Are you sure ?">
    <p>{{ __('Are you sure you want to delete this address?') }}</p>
    <div class="mt-5 flex justify-end">
        <x-form.button classDiv="none" class="p-3 mr-3 bg-gray-200 text-gray-700 hover:bg-gray-300" x-on:click="isDialogOpen = false">{{ __('Cancel') }}</x-form.button>
        <x-form.form-button action="#" method="DELETE" class="p-3 rounded bg-red-500 text-white hover:bg-red-600" x-ref="modalDelete">
            {{ __('Delete this address') }}
        </x-form.form-button>
    </div>
</x-modal>

<section class="my-4 min-h-full container px-5 py-12 mx-auto relative text-gray-700 body-font">
    <div class="flex flex-col text-center w-full mb-20">
        <h2 class="text-2xl font-medium title-font mb-4 tracking-widest uppercase">{{ __('Your addresses') }}</h2>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify, subway tile poke farm-to-table. Franzen you probably haven't heard of them.</p>
        <div class="text-center mt-6">
            <a href="{{ route('users.addresses.create') }}" class="p-3 rounded bg-blue-500 text-white hover:bg-blue-600 inline-flex items-center">
                <span class="mdi mdi-plus-circle text-white text-xl mr-2"></span>
                {{ __('Add a new address') }}
            </a>
        </div>
    </div>
    <livewire:addresses.index />
</section>
@endsection

@section('extra-js')
    <script>
        function setAction(event) {
            document.querySelector('.modal-element form').action = event.target.getAttribute('data-route');
        }
    </script>
@endsection
