@extends('layouts.back')

@section('meta-title')
    {{ __('Settings') }}
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.settings.index') }}" label="{{ __('Settings') }}" />
    <x-back.breadcrumb-item route="{{ route('admin.settings.backup.index') }}" label="{{ __('Backup') }}" active/>
@endsection

@section('content')
    <x-modal title="Are you sure ?">
        <p>{{ __('Are you sure you want to process this action?') }}</p>
        <p class="text-sm text-red-500 inline-flex items-center">
            <span class="mdi mdi-alert mr-2 text-lg"></span>
            {{ __('Some actions can be dangerous!') }}
        </p>
        <div class="mt-5 flex justify-end">
            <x-form.button classDiv="none" class="p-2 mr-3 bg-gray-200 text-gray-700 hover:bg-gray-300" x-on:click="isDialogOpen = false">{{ __('Cancel') }}</x-form.button>
            <x-form.form-button action="#" method="POST" class="p-2 rounded bg-red-500 text-white hover:bg-red-600" x-ref="modalConfirm">
                {{ __('I want to do this') }}
            </x-form.form-button>
        </div>
    </x-modal>

    <h3 class="text-gray-700 text-3xl font-medium">{{ __('Settings Panel') }}</h3>

    <div class="mt-6 flex flex-col md:flex-row justify-between">
        <button type="button" class="bg-gray-300 text-gray-700 inline-flex flex-col justify-center items-center p-4 mb-2 transition-colors duration-200 hover:bg-gray-700 hover:text-blue-300" data-route="{{ route('admin.settings.backup.database') }}" x-on:click="setAction($event); isDialogOpen = true;">
            <span class="mdi mdi-database-sync mb-2 text-3xl"></span>
            <p>{{ __('Backup database') }}</p>
        </button>
        <button type="button" class="bg-gray-300 text-gray-700 inline-flex flex-col justify-center items-center p-4 mb-2 transition-colors duration-200 hover:bg-gray-700 hover:text-blue-300" data-route="{{ route('admin.settings.backup.database') }}" x-on:click="setAction($event); isDialogOpen = true;">
            <span class="mdi mdi-file-document-outline mb-2 text-3xl"></span>
            <p>{{ __('Backup invoices') }}</p>
        </button>
        <button type="button" class="bg-gray-300 text-gray-700 inline-flex flex-col justify-center items-center p-4 mb-2 transition-colors duration-200 hover:bg-gray-700 hover:text-blue-300" data-route="{{ route('admin.settings.backup.database') }}" x-on:click="setAction($event); isDialogOpen = true;">
            <span class="mdi mdi-overscan mb-2 text-3xl"></span>
            <p>{{ __('Backup complete') }}</p>
        </button>
    </div>

    <div class="mt-6 bg-gray-100 p-4">
        <h3 class="text-xl font-semibold">{{ __('Backup history') }}</h3>
    </div>
@endsection

@section('extra-js')
    <script>
        function setAction(event) {
            document.querySelector('.modal-element form').action = event.target.getAttribute('data-route');
        }
    </script>
@endsection
