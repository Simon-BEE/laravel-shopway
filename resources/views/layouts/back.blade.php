<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="turbolinks-cache-control" content="no-preview">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        @yield('meta-desc')

        <title>{{ config('app.name', 'Laravel') }} &bull; ADMIN &bull; @yield('meta-title')</title>

        <!-- Scripts -->
        <script src="{{ asset('js/app.js') }}" defer></script>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@300;400;600&display=swap" rel="stylesheet">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/MaterialDesign-Webfont/5.3.45/css/materialdesignicons.min.css" integrity="sha256-nwNjrH7J9zS/Ti4twtWX7OsC5QdQHCIKTv5cLMsGo68=" crossorigin="anonymous" />

        <!-- Styles -->
        <livewire:styles>
        <link href="{{ mix('css/app.css') }}" rel="stylesheet">
        @yield('extra-css')
</head>
<body class="text-gray-700">
    <div x-data="{ sidebarOpen: false, 'isDialogOpen': false }" class="flex h-screen bg-gray-200 font-family-karla">
        <div :class="sidebarOpen ? 'block' : 'hidden'" @click="sidebarOpen = false" class="fixed z-20 inset-0 bg-black opacity-50 transition-opacity lg:hidden"></div>

        <div :class="sidebarOpen ? 'translate-x-0 ease-out' : '-translate-x-full ease-in'" class="fixed z-30 inset-y-0 left-0 w-64 transition duration-300 transform bg-gray-900 overflow-y-auto lg:translate-x-0 lg:static lg:inset-0">
            <div class="flex items-center justify-center mt-8">
                <div class="flex items-center">
                    <span class="mdi mdi-monitor-dashboard text-xl text-white"></span>
                    <h1 class="text-white text-xl tracking-wider uppercase mx-2">Administration</h1>
                </div>
            </div>

            {{-- sidebar --}}
            <nav class="mt-10">
                {{-- normal link --}}
                <a class="flex items-center mt-4 py-2 px-6 border-l-4 @if(Route::is('admin.dashboard')) bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100 @else border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100 @endif" href="{{ route('admin.dashboard') }}">
                    <span class="mdi mdi-chart-pie text-xl"></span>

                    <span class="mx-4">Dashboard</span>
                </a>

                {{-- dropdown link --}}
                <div class="flex flex-col mt-4 py-2 px-6 border-l-4 @if(Route::is('admin.products.*')) bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100 @else border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100 @endif cursor-pointer" x-data="{ dropdownProducts : false }" @click="dropdownProducts = !dropdownProducts">
                    <div class="flex items-center">
                        <span class="mdi mdi-cart-arrow-down text-xl"></span>

                        <span class="mx-4">Products</span>
                    </div>
                    <ul class="flex flex-col py-2" x-show.transition="dropdownProducts">
                        <li class="hover:bg-gray-500">
                            <a class="block py-2" href="{{ route('admin.products.index') }}"><span class="mr-4">&mdash;</span> Show list</a>
                        </li>
                        <li class="hover:bg-gray-500">
                            <a class="block py-2" href="{{ route('admin.products.create') }}"><span class="mr-4">&mdash;</span> Add new one</a>
                        </li>
                        <li class="hover:bg-gray-500">
                            <a class="block py-2" href="#"><span class="mr-4">&mdash;</span> Categories</a>
                        </li>
                    </ul>
                </div>
                {{-- dropdown link --}}
                <div class="flex flex-col mt-4 py-2 px-6 border-l-4 @if(Route::is('admin.sales.*')) bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100 @else border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100 @endif cursor-pointer" x-data="{ dropdownSales : false }" @click="dropdownSales = !dropdownSales">
                    <div class="flex items-center">
                        <span class="mdi mdi-basket-outline text-xl"></span>

                        <span class="mx-4">Sales</span>
                    </div>
                    <ul class="flex flex-col py-2" x-show.transition="dropdownSales">
                        <li class="hover:bg-gray-500">
                            <a class="block py-2" href="#"><span class="mr-4">&mdash;</span> Orders</a>
                        </li>
                        <li class="hover:bg-gray-500">
                            <a class="block py-2" href="#"><span class="mr-4">&mdash;</span> Payments</a>
                        </li>
                        <li class="hover:bg-gray-500">
                            <a class="block py-2" href="#"><span class="mr-4">&mdash;</span> Shipments</a>
                        </li>
                    </ul>
                </div>
                {{-- dropdown link --}}
                <div class="flex flex-col mt-4 py-2 px-6 border-l-4 @if(Route::is('admin.users.*')) bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100 @else border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100 @endif cursor-pointer" x-data="{ dropdownUsers : false }" @click="dropdownUsers = !dropdownUsers">
                    <div class="flex items-center">
                        <span class="mdi mdi-account-group-outline text-xl"></span>

                        <span class="mx-4">Users</span>
                    </div>
                    <ul class="flex flex-col py-2" x-show.transition="dropdownUsers">
                        <li class="hover:bg-gray-500">
                            <a class="block py-2" href="#"><span class="mr-4">&mdash;</span> Show list</a>
                        </li>
                        <li class="hover:bg-gray-500">
                            <a class="block py-2" href="#"><span class="mr-4">&mdash;</span> Add new one</a>
                        </li>
                    </ul>
                </div>
                {{-- normal link --}}
                <a class="flex items-center mt-4 py-2 px-6 border-l-4 @if(Route::is('admin.settings')) bg-gray-600 bg-opacity-25 text-gray-100 border-gray-100 @else border-gray-900 text-gray-500 hover:bg-gray-600 hover:bg-opacity-25 hover:text-gray-100 @endif" href="#">
                    <span class="mdi mdi-cellphone-cog text-xl"></span>

                    <span class="mx-4">Settings</span>
                </a>
            </nav>
        </div>
        <div class="flex-1 flex flex-col overflow-hidden">
            <header class="flex justify-between items-center py-4 px-6 bg-white border-b-4 border-gray-300">
                <div class="flex items-center">
                    <button @click="sidebarOpen = true" class="text-gray-500 focus:outline-none lg:hidden">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M4 6H20M4 12H20M4 18H11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    {{-- search --}}
                    <div class="relative mx-4 lg:mx-0">
                        <span class="absolute inset-y-0 left-0 pl-3 flex items-center">
                            <svg class="h-5 w-5 text-gray-500" viewBox="0 0 24 24" fill="none">
                                <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </span>

                        <input class="form-input w-32 sm:w-64 rounded-md pl-10 pr-4 focus:border-indigo-600" type="text" placeholder="Search">
                    </div>
                </div>

                {{-- notif and user --}}
                <div class="flex items-center">
                    <button class="flex mx-4 text-gray-600 focus:outline-none">
                        <svg class="h-6 w-6" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M15 17H20L18.5951 15.5951C18.2141 15.2141 18 14.6973 18 14.1585V11C18 8.38757 16.3304 6.16509 14 5.34142V5C14 3.89543 13.1046 3 12 3C10.8954 3 10 3.89543 10 5V5.34142C7.66962 6.16509 6 8.38757 6 11V14.1585C6 14.6973 5.78595 15.2141 5.40493 15.5951L4 17H9M15 17V18C15 19.6569 13.6569 21 12 21C10.3431 21 9 19.6569 9 18V17M15 17H9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        </svg>
                    </button>

                    <div x-data="{ dropdownOpen: false }"  class="relative">
                        <button @click="dropdownOpen = !dropdownOpen" class="relative z-10 block h-8 w-8 rounded-full overflow-hidden shadow focus:outline-none">
                            <img class="h-full w-full object-cover" src="https://images.unsplash.com/photo-1528892952291-009c663ce843?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=296&q=80" alt="Your avatar">
                        </button>

                        <div x-show="dropdownOpen" @click="dropdownOpen = false" class="fixed inset-0 h-full w-full z-10"></div>

                        <div x-show="dropdownOpen" class="absolute right-0 mt-2 py-2 w-48 bg-white rounded-md shadow-xl z-20">
                            <a href="{{ route('welcome') }}" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                                <span class="mdi mdi-backburger mr-2"></span>
                                Back to site
                            </a>
                            <a href="#" class="block px-4 py-2 text-sm text-gray-700 hover:bg-gray-200">
                                <span class="mdi mdi-account-cog mr-2"></span>
                                Settings
                            </a>
                            <div class="block px-4 py-2 text-sm text-red-500 hover:bg-gray-200">
                                <x-form.form-button action="{{ route('logout') }}" class="">
                                    <span class="mdi mdi-power mr-2"></span>
                                    {{ __('Logout') }}
                                </x-form.form-button>
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <main class="flex-1 overflow-x-hidden overflow-y-auto bg-gray-200">
                @if (session()->has('type'))
                    <x-alert type="{{ session('type') }}">{{ session()->has('message') ? session('message') : '' }}</x-alert>
                @endif
                <div class="container mx-auto px-6 py-8">
                    @yield('content')
                </div>
            </main>
        </div>
    </div>
    <livewire:scripts>
    @yield('extra-js')
</body>
</html>
