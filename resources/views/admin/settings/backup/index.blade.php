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

    <div class="flex flex-col md:flex-row items-center justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">{{ __('Backup Manager') }}</h3>

        <div class="mt-6 flex flex-col md:flex-row">
            <button type="button" class="bg-gray-300 text-gray-700 inline-flex rounded-l justify-center items-center px-2 mb-2 transition-colors duration-200 hover:bg-gray-700 hover:text-blue-300" data-route="{{ route('admin.settings.backup.database') }}" x-on:click="setAction($event); isDialogOpen = true;">
                <span class="mdi mdi-database-sync text-3xl mr-2"></span>
                <p>{{ __('Backup database') }}</p>
            </button>
            <button type="button" class="bg-gray-300 text-gray-700 inline-flex justify-center items-center px-2 mb-2 transition-colors duration-200 hover:bg-gray-700 hover:text-blue-300" data-route="{{ route('admin.settings.backup.database') }}" x-on:click="setAction($event); isDialogOpen = true;">
                <span class="mdi mdi-file-document-outline text-3xl mr-2"></span>
                <p>{{ __('Backup invoices') }}</p>
            </button>
            <button type="button" class="bg-gray-300 text-gray-700 inline-flex rounded-r justify-center items-center px-2 mb-2 transition-colors duration-200 hover:bg-gray-700 hover:text-blue-300" data-route="{{ route('admin.settings.backup.database') }}" x-on:click="setAction($event); isDialogOpen = true;">
                <span class="mdi mdi-overscan text-3xl mr-2"></span>
                <p>{{ __('Backup complete') }}</p>
            </button>
        </div>
    </div>

    <div class="mt-6 bg-gray-100 p-4">
        <div class="flex justify-between items-center">
            <h3 class="text-xl font-semibold">{{ __('Backup history') }}</h3>

            {{-- <x-form.form-button action="{{ route('admin.settings.backup.clean') }}" method="POST" class="p-2 rounded bg-transparent text-gray-700 hover:bg-gray-300" title="{{ __('Clean backups') }}">
                <span class="mdi mdi-refresh"></span>
            </x-form.form-button> --}}
            <button type="button" class="p-2 rounded bg-transparent text-gray-700 hover:bg-gray-300" data-route="{{ route('admin.settings.backup.clean') }}" x-on:click="setAction($event); isDialogOpen = true;">
                <span class="mdi mdi-refresh"></span>
            </button>
        </div>
        <section class="mt-6 flex flex-col">
            @forelse ($backups as $date => $backup)
                <article class="p-5 flex items-center justify-between {{ $loop->odd ? 'bg-gray-200' : '' }} hover:bg-gray-300">
                    <p>
                        <span class="mdi mdi-arrow-right-bold-circle-outline"></span>
                        <span class="ml-2">{{ __('Backup from') }} <span class="font-semibold">{{ $date }}</span></span>
                    </p>
                    <x-form.mini-form action="{{ route('admin.settings.backup.download') }}" method="POST">
                        <input type="hidden" name="backup" value="{{ $backup }}">
                        <button type="submit" class="text-blue-500 hover:underline flex">
                            <span class="mdi mdi-download mr-2"></span>
                            {{ __('Download') }}
                        </button>
                    </x-form.mini-form>
                </article>
            @empty
                
            @endforelse
        </section>
    </div>
@endsection

@section('extra-js')
    <script>
        function setAction(event) {
            document.querySelector('.modal-element form').action = event.currentTarget.getAttribute('data-route');
        }
    </script>
@endsection