<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @yield('meta-desc')

    <title>{{ config('app.name', 'Laravel') }} &bull; @yield('meta-title')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css" integrity="sha256-nwNjrH7J9zS/Ti4twtWX7OsC5QdQHCIKTv5cLMsGo68=" crossorigin="anonymous" />

    <!-- Styles -->
    <link href="{{ mix('css/app.css') }}" rel="stylesheet">
    @yield('extra-css')
</head>
<body class="bg-gray-100 min-h-screen antialiased leading-none font-perso relative"  x-data="{ 'isDialogOpen': false }">
    <!--Nav-->
    <header id="header" class="w-full z-30 top-0 py-1 bg-gray-900 mb-4">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3">

            <label for="menu-toggle" class="cursor-pointer md:hidden block">
                <svg class="fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                    <title>menu</title>
                    <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
                </svg>
            </label>
            <input class="hidden" type="checkbox" id="menu-toggle" />

            <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-2" id="menu">
                <nav>
                    <ul class="md:flex items-center justify-between text-base text-gray-300 pt-4 md:pt-0">
                        <li class="px-2"><a class="inline-block no-underline py-2 px-2 border-b border-transparent hover:border-blue-400" href="{{ route('welcome') }}">Home</a></li>
                        <li class="px-2"><a class="inline-block no-underline py-2 px-2 border-b border-transparent hover:border-blue-400" href="#">Products</a></li>
                        <li class="px-2"><a class="inline-block no-underline py-2 px-2 border-b border-transparent hover:border-blue-400" href="#">Contact</a></li>
                    </ul>
                </nav>
            </div>

            <div class="order-1">
                <a class="flex items-center tracking-wide no-underline hover:no-underline text-gray-700 text-xl tracking-widest" href="{{ route('welcome') }}">
                    <span class="mdi mdi-store-outline mr-2"></span>
                    SHOP<span class="font-semibold text-gray-700"><span class="text-blue-400">WAY</span></span>
                </a>
            </div>

            <div class="mt-3 ml-auto sm:mt-0 sm:ml-0 order-2 md:order-3 flex items-center" id="nav-content">
                @auth
                <a class="inline-block no-underline hover:text-black" href="#">
                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <circle fill="none" cx="12" cy="7" r="3" />
                        <path d="M12 2C9.243 2 7 4.243 7 7s2.243 5 5 5 5-2.243 5-5S14.757 2 12 2zM12 10c-1.654 0-3-1.346-3-3s1.346-3 3-3 3 1.346 3 3S13.654 10 12 10zM21 21v-1c0-3.859-3.141-7-7-7h-4c-3.86 0-7 3.141-7 7v1h2v-1c0-2.757 2.243-5 5-5h4c2.757 0 5 2.243 5 5v1H21z" />
                    </svg>
                </a>
                @else
                <a href="{{ route('login') }}"
                    class="bg-white text-gray-800 font-bold rounded border-b-2 border-blue-500 hover:border-blue-600 hover:bg-blue-500 hover:text-white shadow-md py-2 px-4 inline-flex items-center mr-3">
                    <span class="mdi mdi-login mr-2"></span>
                    Sign In
                </a>
                <a href="{{ route('register') }}"
                    class="bg-white text-gray-800 font-bold rounded border-b-2 border-yellow-500 hover:border-yellow-600 hover:bg-yellow-500 hover:text-white shadow-md py-2 px-4 inline-flex items-center">
                    <span class="mdi mdi-account-plus mr-2"></span>
                    Sign Up
                </a>
                @endauth
                <a href="" class="text-gray-700 text-thin text-xl ml-3">
                    <span class="mdi mdi-cart-outline mr-2"></span>
                </a>
            </div>
        </div>
    </header>

    <!--Main content-->
    <main class="bg-whithe">
        @yield('content')
    </main>

    <!--Footer-->
    <footer class="bg-gray-900 text-gray-200 w-full py-4 border-t-4 border-gray-400">
        <div class="container mx-auto flex flex-col px-3 py-8 ">
            <div class="w-full mx-auto flex flex-wrap">
                <div class="flex w-full lg:w-1/2 ">
                    <div class="px-3 md:px-0">
                        <h3 class="font-bold text-gray-900">About</h3>
                        <p class="py-4">
                            You... are trouble. I'm sorry the kid here doesn't see it, but I sure as hell do. You are a time bomb. Tick, tick, ticking. And I have no intention of being around for the boom. Well... you know how they say, it's been a pleasure? It hasn't.
                        </p>
                    </div>
                </div>
                <div class="flex w-full lg:w-1/2 lg:justify-end lg:text-right">
                    <div class="px-3 md:px-0">
                        <h3 class="font-bold text-gray-900">Links</h3>
                        <ul class="list-reset items-center pt-3">
                            <li>
                                <a class="inline-block no-underline hover:text-black hover:underline py-1" href="{{ route('welcome') }}">Homepage</a>
                            </li>
                            <li>
                                <a class="inline-block no-underline hover:text-black hover:underline py-1" href="#">Products</a>
                            </li>
                            <li>
                                <a class="inline-block no-underline hover:text-black hover:underline py-1" href="#">Contact</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="text-center md:text-left text-xs text-gray-500">
                <a href="#">Terms</a>
                <span class="mx-2">&bull;</span>
                <a href="#">Legal Notice</a>
                <span class="mx-2">&bull;</span>
                <a href="#">Pricing Policy</a>
            </div>
        </div>
    </footer>
    @yield('extra-js')
</body>
</html>
