<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta-desc')

        <title>{{ config('app.name', 'Laravel') }} &bull; @yield('meta-title')</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css" integrity="sha256-nwNjrH7J9zS/Ti4twtWX7OsC5QdQHCIKTv5cLMsGo68=" crossorigin="anonymous" />

        <!-- Styles -->
        <livewire:styles>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @yield('extra-css')
        <script src="{{ asset('js/app.js') }}" defer></script>
    </head>

    <body class="bg-white min-h-screen antialiased leading-none font-perso relative" x-data="{ 'isDialogOpen': false }">
        <!--Nav-->
        <x-includes.header />


        @yield('modal')

        <!--Main content-->
        <main class="relative">
            @if (session()->has('type'))
                <x-alert type="{{ session('type') }}">{{ session()->has('message') ? session('message') : '' }}</x-alert>
            @endif
            <section class="breadcrumb w-full bg-gray-700 border-b-4 border-gray-200 py-3 px-4 flex flex-wrap">
                <a href="{{ route('welcome') }}" class="text-white hover:underline @if(Route::is('welcome')) text-blue-200 @endif">Home</a>
                @yield('breadcrumb')
            </section>

            <section class="container mx-auto">
                @yield('content')
            </section>
        </main>

        <!--Footer-->
        <x-includes.footer />
        <livewire:scripts>

        <script>
            window.onload = () => {
                window.livewire.on('addToCart', () => {
                    let modalProductElement = document.querySelector('.modal-product');
                    window.livewire.emit('addToCartFromModal', modalProductElement.getAttribute('data-product'));
                });
                window.livewire.on('addToWishlist', () => {
                    let modalProductElement = document.querySelector('.modal-product');
                    window.livewire.emit('addToWishlistFromModal', modalProductElement.getAttribute('data-product'));
                });
            }
        </script>
        @yield('extra-js')
    </body>
</html>
