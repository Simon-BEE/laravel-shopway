<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

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
    <body class="bg-gray-100 font-family-karla flex">
        <main class="flex">
            <aside class="relative bg-sidebar h-screen w-64 hidden sm:block shadow-xl">
                <div class="p-6">
                    <a href="{{ route('admin') }}" class="text-white text-3xl uppercase hover:text-gray-300">Admin<span class="font-semibold">PANEL</span></a>
                </div>
                <nav class="text-white text-base font-semibold pt-3">
                    <a href="{{ route('admin') }}" class="flex items-center active-nav-link text-white py-4 pl-6 nav-item">
                        <span class="mdi mdi-monitor-dashboard mr-2"></span>
                        Dashboard
                    </a>
                    <a href="" class="menu-link nav-item">
                        <span class="mdi mdi-file-table-box-multiple mr-2"></span>
                        Catégories
                    </a>
                    <a href="" class="menu-link nav-item">
                        <span class="mdi mdi-cart-arrow-down mr-2"></span>
                        Produits
                    </a>
                    <a href="#" class="menu-link nav-item">
                        <span class="mdi mdi-account-group-outline mr-2"></span>
                        Utilisateurs
                    </a>
                    <a href="#" class="menu-link nav-item">
                        <span class="mdi mdi-cellphone-cog mr-2"></span>
                        Paramètres
                    </a>
                </nav>
                <a href="{{ route('welcome') }}" class="absolute w-full upgrade-btn bottom-0 active-nav-link text-white flex items-center justify-center py-4">
                    <span class="mdi mdi-arrow-left-circle mr-2"></span>
                    Retour au site
                </a>
            </aside>

            <div class="w-full flex flex-col h-screen overflow-y-hidden">
                <!-- Desktop Header -->
                <header class="w-full flex items-center bg-white py-2 px-6 hidden sm:flex">
                    <div class="w-1/2"></div>
                    <div x-data="{ isOpen: false }" class="relative w-1/2 flex justify-end">
                        <button @click="isOpen = !isOpen" class="relative z-10 w-10 h-10 rounded-full overflow-hidden">
                            <span class="mdi mdi-account-circle-outline text-3xl text-gray-600"></span>
                        </button>
                        <button x-show="isOpen" @click="isOpen = false" class="h-full w-full fixed inset-0 cursor-default"></button>
                        <div x-show="isOpen" class="absolute w-40 bg-white rounded-lg shadow-lg py-2 mt-16 z-10">
                            <a href="#" class="block px-4 py-2 account-link hover:text-white">Mon Compte</a>
                            <a href="{{ route('welcome') }}" class="block px-4 py-2 account-link hover:text-white">Retour au site</a>
                            <a href="#" class="block px-4 py-2 account-link text-red-500 hover:text-white">Déconnexion</a>
                        </div>
                    </div>
                </header>

                <!-- Mobile Header & Nav -->
                <header x-data="{ isOpen: false }" class="w-full bg-sidebar py-5 px-6 sm:hidden">
                    <div class="flex items-center justify-between">
                        <a href="{{ route('admin') }}" class="text-white text-3xl uppercase hover:text-gray-300">Admin<span class="font-semibold">PANEL</span></a>
                        <button @click="isOpen = !isOpen" class="text-white text-3xl focus:outline-none">
                            <span x-show="!isOpen" class="mdi mdi-dots-vertical"></span>
                            <span x-show="isOpen" class="">&times;</span>
                        </button>
                    </div>

                    <!-- Dropdown Nav -->
                    <nav :class="isOpen ? 'flex': 'hidden'" class="flex flex-col pt-4">
                        <a href="{{ route('admin') }}" class="flex items-center active-nav-link text-white py-2 pl-4 nav-item">
                            <span class="mdi mdi-monitor-dashboard mr-2"></span>
                            Dashboard
                        </a>
                        <a href="" class="menu-mobile-link nav-item">
                            <span class="mdi mdi-file-table-box-multiple mr-2"></span>
                            Catégories
                        </a>
                        <a href="" class="menu-mobile-link nav-item">
                            <span class="mdi mdi-cart-arrow-down mr-2"></span>
                            Produits
                        </a>
                        <a href="#" class="menu-mobile-link nav-item">
                            <span class="mdi mdi-account-group-outline mr-2"></span>
                            Utilisateurs
                        </a>
                        <a href="#" class="menu-mobile-link nav-item">
                            <span class="mdi mdi-cellphone-cog mr-2"></span>
                            Paramètres
                        </a>
                        <a href="#" class="menu-mobile-link nav-item">
                            <span class="mdi mdi-account-box-outline mr-2"></span>
                            Mon Compte
                        </a>
                        <a href="#" class="menu-mobile-link nav-item">
                            <span class="mdi mdi-logout mr-2"></span>
                            Déconnexion
                        </a>
                        <a href="{{ route('welcome') }}" class="w-full bg-white cta-btn font-semibold py-2 mt-3 rounded-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
                            <span class="mdi mdi-arrow-left-circle mr-2"></span>
                            Retour au site
                        </a>
                    </nav>
                </header>

                {{-- Content  --}}
                <div class="w-full h-full overflow-x-hidden border-t flex flex-col">
                    <section class="w-full h-full flex-grow p-6">
                        @yield('content')
                    </section>
                </div>
            </div>
        </main>
    <script>
        // Modal
        const modal = document.querySelector("#modal");
        const modalOverlay = document.querySelector("#modal-overlay");
        const openButton = document.querySelector("#open-button");
        const closeButton = document.querySelector("#close-button");

        openButton.addEventListener("click", () => {
            modal.classList.toggle("hidden");
            modalOverlay.classList.toggle("hidden");
        });

        closeButton.addEventListener("click", () => {
            modal.classList.toggle("hidden");
            modalOverlay.classList.toggle("hidden");
        });

        window.onclick = function (event) {
            if (!modalOverlay.classList.contains('hidden') && event.target == modalOverlay) {
                modalOverlay.classList.add("hidden");
                modal.classList.add("hidden");
            }

        };
    </script>
    </body>
</html>
