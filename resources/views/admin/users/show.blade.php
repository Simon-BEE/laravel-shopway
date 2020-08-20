@extends('layouts.back')

@section('meta-title')
    {{ $user->full_name }}
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.users.index') }}" label="List of users"/>
    <x-back.breadcrumb-item route="{{ route('admin.users.show', $user) }}" label="{{ $user->full_name }}" active/>
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

<section class="mb-12 min-h-full px-6 py-10 relative bg-white">
    <div class="absolute top-0 right-0 mr-2 mt-2">
        <a href="#" class="bg-white p-2 rounded inline-flex text-orange-400 hover:text-orange-600 hover:bg-gray-100 mr-2">
            <span class="text-lg mdi mdi-pencil-outline"></span>
        </a>
        <button type="button" class="bg-white p-2 rounded inline-flex text-red-400 hover:text-red-600 hover:bg-gray-100">
            <span class="text-lg mdi mdi-delete-outline" data-route="{{ route('admin.users.destroy', $user) }}" x-on:click="setAction($event); isDialogOpen = true;"></span>
        </button>
    </div>
    <div class="flex flex-col text-center w-full mb-10 md:mb-20">
        <h2 class="text-2xl font-medium title-font mb-4 tracking-widest uppercase">
            {{ $user->full_name }} 
            <span class="text-gray-500">({{ Format::date($user->created_at) }})</span>
        </h2>
        <p class="lg:w-2/3 mx-auto leading-relaxed text-base">
            Whatever cardigan tote bag tumblr hexagon brooklyn asymmetrical gentrify, subway tile poke farm-to-table. Franzen you probably haven't heard of them.
        </p>
    </div>

    <section class="flex flex-col my-6">
        <h3 class="text-xl tracking-widest font-semibold text-gray-700 mb-4">{{ __('Personnal informations') }}</h3>
        <article class="flex flex-col md:flex-row justify-between">
            <div class="img w-64 h-64 border border-dashed bg-gray-100"></div>
            <div class="w-2/3 flex flex-col md:flex-row">
                <div class="">
                    <p>{{ __('Firstname') }}: <span class="font-semibold ml-2">{{ $user->firstname }}</span></p>
                    <p>{{ __('Lastname') }}: <span class="font-semibold ml-2">{{ $user->lastname }}</span></p>
                    <p>{{ __('Email') }}: <span class="font-semibold ml-2">{{ $user->email }}</span></p>
                </div>
                <div class="md:ml-12">
                    <p>{{ __('Last login at') }}: 
                        <span class="font-semibold ml-2">{{ $user->last_login_at ? Format::date($user->last_login_at, 'd/m/Y H:i') : __('Never') }}</span>
                    </p>
                    <p>{{ __('Subscribed to Newsletter?') }} 
                        <span class="ml-3 rounded-lg bg-gray-100 p-2 {{ $user->newsletter ? 'text-green-500' : 'text-red-500' }}">{{ $user->newsletter ? __('Yes') : __('No') }}</span>
                    </p>
                </div>
            </div>
        </article>
    </section>

    <section class="flex flex-col my-6">
        <h3 class="text-xl tracking-widest font-semibold text-gray-700 mb-4">{{ __('Addresses') }}</h3>
        <div class="flex flex-col md:flex-row justify-between flex-wrap">
            @forelse ($user->addresses as $address)
                <div class="mt-2 w-5/12 relative">
                    <div class="absolute top-0 right-0 mr-2 mt-2">
                        <x-form.form-button action="{{ route('admin.addresses.destroy', $address) }}" method="DELETE" class="p-1 rounded bg-white text-red-500 hover:text-white hover:bg-red-600">
                            <span class="text-lg mdi mdi-delete-outline"></span>
                        </x-form.form-button>
                    </div>
                    <div class="space-y-6 p-2 border-dashed {{ $address->is_main ? 'border' : '' }}">
                        <h3 class="title-font font-medium text-lg text-gray-900 flex items-center uppercase">
                            <span class="mdi mdi-account-details-outline text-gray-600 text-xl font-semibold mr-6" title="User name"></span>
                            {{ $address->full_name }}
                            <span class="text-xs text-gray-500 ml-1 normal-case">({{ $address->city }}, {{ $address->country->name }})</span>
                            @if($address->professionnal)
                                <span class="text-xs text-gray-500 ml-1 normal-case">{{ $address->company }}</span>
                            @endif
                        </h3>
                        <p class="flex items-center">
                            <span class="mdi mdi-home-city-outline text-gray-600 text-xl font-semibold mr-6" title="address"></span>
                            {{ $address->full_address }}
                        </p>
                        <p class="flex items-center">
                            <span class="mdi mdi-cellphone-iphone text-gray-600 text-xl font-semibold mr-6" title="phone number"></span>
                            {{ $address->phone }}
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-red-500">{{ __('Address not found') }}</p>
            @endforelse
        </div>
    </section>

    <section class="flex flex-col my-6">
        <h3 class="text-xl tracking-widest font-semibold text-gray-700 mb-4">{{ __('Orders') }}</h3>
        <div class="">
            @forelse ($user->orders as $order)
                <div class="mt-2 w-full relative">
                    <div class="bg-gray-100 flex justify-between p-2">
                        <div class="flex items-center">
                            <h3 class="title-font font-medium text-lg text-gray-900  uppercase">
                                {{ __('Order n°') }}{{ $order->id }}
                            </h3>
                            <span class="mx-10 text-sm">
                                {{ Format::date($order->created_at) }}
                            </span>
                            <span class="font-semibold">
                                {{ Format::priceWithCurrency($order->price) }}
                            </span>
                        </div>
                        <p>
                            <a href="{{ route('admin.orders.show', $order) }}" class="ml-6 text-blue-500 hover:underline">Details</a>
                        </p>
                    </div>
                </div>
            @empty
                <p class="text-gray-500">&rarr; {{ __('Customers never ordered') }}</p>
            @endforelse
        </div>
    </section>
</section>

@endsection

@section('extra-js')
    <script>
        function setAction(event) {
            document.querySelector('.modal-element form').action = event.target.getAttribute('data-route');
        }
    </script>
@endsection