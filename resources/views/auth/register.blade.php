@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    {{ __('Register') }}
@endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('register') }}" label="{{ __('Register') }}" active classActiv="text-yellow-500" />
@endsection

@section('content')
    <div class="container mx-auto">
        <div class="w-full max-w-sm mx-auto">
            <h2 class="font-semibold text-xl tracking-wide text-gray-700 py-3 px-6 mb-0">
                &rarr; {{ __('Register') }}
            </h2>
            <div class="flex flex-col break-words bg-white border border-2 p-4 rounded shadow-md">

                    <form class="w-full p-6" method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="flex flex-wrap mb-6">
                            <label for="email" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('E-Mail Address') }}:
                            </label>

                            <input id="email" type="email" class="form-input w-full @error('email') border-red-500 @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                            @error('email')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Password') }}:
                            </label>

                            <input id="password" type="password" class="form-input w-full @error('password') border-red-500 @enderror" name="password" required autocomplete="new-password">

                            @error('password')
                                <p class="text-red-500 text-xs italic mt-4">
                                    {{ $message }}
                                </p>
                            @enderror
                        </div>

                        <div class="flex flex-wrap mb-6">
                            <label for="password-confirm" class="block text-gray-700 text-sm font-bold mb-2">
                                {{ __('Confirm Password') }}:
                            </label>

                            <input id="password-confirm" type="password" class="form-input w-full" name="password_confirmation" required autocomplete="new-password">
                        </div>

                        <div class="flex flex-wrap">
                            <button type="submit" class="inline-block align-middle text-center select-none border font-bold whitespace-no-wrap py-2 px-4 rounded text-base leading-normal no-underline text-gray-100 bg-blue-500 hover:bg-blue-700">
                                {{ __('Register') }}
                            </button>

                            <p class="w-full text-xs text-center text-gray-700 mt-8 -mb-4">
                                {{ __('Already have an account?') }}
                                <a class="text-blue-500 hover:text-blue-700 no-underline" href="{{ route('login') }}">
                                    {{ __('Login') }}
                                </a>
                            </p>
                        </div>
                    </form>

                </div>
            </div>
    </div>
@endsection
