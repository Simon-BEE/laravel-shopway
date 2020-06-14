<header id="header" class="w-full z-30 top-0 py-1 bg-gray-900 mb-4 border-b-4 border-gray-200 ">
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
            <a href="#" class="absolute left-0 md:left-auto md:right-0 md:top-0 ml-3 md:ml-0 md:mr-3 mt-3 rounded-full bg-gray-100 text-gray-700 text-xl text-center p-2 hover:bg-transparent hover:text-white transition-colors duration-200">
                <span class="mdi mdi-cart-outline"></span>
            </a>
        </div>
    </div>
</header>
