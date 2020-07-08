@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
{{ __('Add a new address') }}
@endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('users.dashboard') }}" label="{{ __('Account') }}" />
    <x-breadcrumb-item route="{{ route('users.addresses.index') }}" label="{{ __('Addresses') }}" />
    <x-breadcrumb-item route="{{ route('users.addresses.create') }}" label="{{ __('Add a new address') }}" active />
@endsection

@section('content')

<section class="my-10 min-h-full px-6 py-10 relative">
    <article class="mb-8 flex items-end">
        <h2 class="text-2xl font-semibold text-gray-700">{{ __('Add a new address') }}</h2>
    </article>
    <form action="{{ route('users.addresses.store') }}" method="post" x-data="{showCompany: false}">
        @csrf

        <h2 class="text-xl font-semibold text-gray-600 mb-5">{{ __('Personnal information') }}</h2>
        <div class="flex flex-col md:flex-row justify-between mt-3">
            <div class="w-full md:w-5/12">
                <x-form.input
                    label="{{ __('Firstname') }}"
                    type="text"
                    name="firstname"
                    placeholder="{{ __('Firstname') }}"
                    value="{{ old('firstname') }}"
                    required
                />
            </div>
            <div class="w-full md:w-5/12">
                <x-form.input
                    label="{{ __('Lastname') }}"
                    type="text"
                    name="lastname"
                    placeholder="{{ __('Lastname') }}"
                    value="{{ old('lastname') }}"
                    required
                />
            </div>
        </div>
        <x-form.input
            label="{{ __('Phone number') }}"
            type="text"
            name="phone"
            placeholder="{{ __('Phone number') }}"
            value="{{ old('phone') }}"
            required
        />
        <x-form.checkbox 
            name="professionnal"
            label="{{ __('This is a professionnal address') }}"
            value=1
            x-on:click="showCompany = !showCompany"
        />
        <div class="flex flex-wrap mb-4" x-show.transition="showCompany">
            <div class="flex justify-between w-full items-center mb-2">
                <label class="label text-gray-700" for="company">
                    {{ __('Company name') }}
                </label>
            </div>
            <input
                type="text"
                name="company"
                id="company"
                class="form-input w-full border-gray-200 @error('company') border-red-500 @enderror"
                placeholder="{{ __('Company name') }}"
                value="{{ old('company') }}"
            >
            @error('company')
            <x-form.error>
                {{ $message }}
            </x-form.error>
            @enderror
        </div>

        <hr class="my-12">

        <h2 class="text-xl font-semibold text-gray-600 mb-5">{{ __('Shipping information') }}</h2>
        <x-form.input
            label="{{ __('Street address') }}"
            type="text"
            name="address"
            placeholder="{{ __('Street address') }}"
            value="{{ old('address') }}"
            required
        />
        <x-form.input
            label="{{ __('Additional address') }}"
            type="text"
            name="info_address"
            placeholder="{{ __('Additional address') }}"
            value="{{ old('info_address') }}"
            helper="{{ __('If you have more information to give') }}"
        />

        <div class="flex flex-col md:flex-row justify-between mt-3">
            <div class="w-full md:w-1/4">
                <x-form.input
                    label="{{ __('City') }}"
                    type="text"
                    name="city"
                    placeholder="{{ __('City') }}"
                    value="{{ old('city') }}"
                    required
                />
            </div>
            <div class="w-full md:w-1/4">
                <x-form.input
                    label="{{ __('Postal code') }}"
                    type="text"
                    name="zipcode"
                    placeholder="{{ __('Postal code') }}"
                    value="{{ old('zipcode') }}"
                    required
                />
            </div>
            <div class="w-full md:w-1/4">
                <x-form.select 
                    label="Select a country"
                    name="country_id"
                    required
                >
                    @foreach ($countries as $country)
                        <option value="{{ $country->id }}">{{ $country->name }}</option>
                    @endforeach
                </x-form.select>
            </div>
        </div>

        <hr class="my-12">
        <x-form.input
            label="{{ __('Give a name to this address') }}"
            type="text"
            name="name"
            placeholder="{{ __('Address name') }}"
            value="{{ old('name') }}"
            required
        />
        <x-form.button class="p-4 mt-2 bg-blue-600 hover:bg-blue-500">
            {{ __('Add a new address') }}
        </x-form.button>
    </form>
</section>

@endsection