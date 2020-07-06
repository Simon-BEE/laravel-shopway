<header id="header" class="w-full z-30 top-0 py-1 bg-gray-900">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-6 py-3 relative">

        <label for="menu-toggle" class="cursor-pointer md:hidden block">
            <svg class="fill-current text-gray-300" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 20 20">
                <title>menu</title>
                <path d="M0 3h20v2H0V3zm0 6h20v2H0V9zm0 6h20v2H0v-2z"></path>
            </svg>
        </label>
        <input class="hidden" type="checkbox" id="menu-toggle" />

        <div class="hidden md:flex md:items-center md:w-auto w-full order-3 md:order-2 md:mr-16" id="menu">
            <nav>
                <ul class="md:flex items-center justify-between text-base text-gray-300 pt-4 md:pt-0">
                    <li class="px-2">
                        <a class="inline-block no-underline py-2 px-2 border-b border-transparent @if(Route::is('welcome')) border-blue-400 @else hover:border-blue-400 @endif" href="{{ route('welcome') }}">
                            Home
                        </a>
                    </li>
                    <li class="px-2">
                        <a class="inline-block no-underline py-2 px-2 border-b border-transparent @if(Route::is('products.index')) border-blue-400 @else hover:border-blue-400 @endif" href="{{ route('products.index') }}">
                            Products
                        </a>
                    </li>
                    <li class="px-2">
                        <a class="inline-block no-underline py-2 px-2 border-b border-transparent @if(Route::is('contact')) border-blue-400 @else hover:border-blue-400 @endif" href="{{ route('contact') }}">
                            Contact
                        </a>
                    </li>
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
            @guest
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
            @endguest
            <div class="absolute right-0 top-0 mr-3 mt-2 md:mt-3 flex">
                @auth
                    <a class="rounded-full bg-gray-100 text-gray-700 text-xl text-center p-2 hover:bg-transparent hover:text-white transition-colors duration-200" href="{{ route('users.dashboard') }}">
                        <span class="mdi mdi-account"></span>
                    </a>
                    <livewire:cart.icon />
                @endauth
            </div>
        </div>
    </div>
</header>
