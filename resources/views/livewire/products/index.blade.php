<div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
    <nav id="store" class="w-full z-30 top-0 px-6 py-1" x-data="{searchDiv : false}">
        <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
            <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                Store
            </a>
            <div class="flex items-center" id="store-nav-content">
                <button class="pl-3 inline-block no-underline hover:text-black" @click="searchDiv = !searchDiv">
                    <svg class="fill-current hover:text-black" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24">
                        <path d="M10,18c1.846,0,3.543-0.635,4.897-1.688l4.396,4.396l1.414-1.414l-4.396-4.396C17.365,13.543,18,11.846,18,10 c0-4.411-3.589-8-8-8s-8,3.589-8,8S5.589,18,10,18z M10,4c3.309,0,6,2.691,6,6s-2.691,6-6,6s-6-2.691-6-6S6.691,4,10,4z" />
                    </svg>
                </button>
                <div x-show.transition="searchDiv">
                    <x-form.input
                        classDiv=""
                        type="text"
                        name="search"
                        placeholder="Search..."
                        wire:model="search"
                    />
                </div>
            </div>
        </div>
    </nav>
    @forelse ($products as $product)
    <div class="w-full md:w-1/3 xl:w-1/4 p-6 flex flex-col">
        <div class="cursor-pointer">
            <div class="img hover:grow hover:shadow-lg w-72 h-48">
                <img class="w-full h-full object-cover rounded shadow-lg" src="https://picsum.photos/300/300?random={{ mt_rand(1, 15) }}">
            </div>
            <div class="pt-3 flex items-center justify-between">
                <p class="">{{ ucfirst($product->title) }}</p>
                <a href="#" @click.stop="alert('ok')">
                    <svg class="h-6 w-6 fill-current text-gray-500 hover:text-red-400 z-10" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24">
                        <path d="M12,4.595c-1.104-1.006-2.512-1.558-3.996-1.558c-1.578,0-3.072,0.623-4.213,1.758c-2.353,2.363-2.352,6.059,0.002,8.412 l7.332,7.332c0.17,0.299,0.498,0.492,0.875,0.492c0.322,0,0.609-0.163,0.792-0.409l7.415-7.415 c2.354-2.354,2.354-6.049-0.002-8.416c-1.137-1.131-2.631-1.754-4.209-1.754C14.513,3.037,13.104,3.589,12,4.595z M18.791,6.205 c1.563,1.571,1.564,4.025,0.002,5.588L12,18.586l-6.793-6.793C3.645,10.23,3.646,7.776,5.205,6.209 c0.76-0.756,1.754-1.172,2.799-1.172s2.035,0.416,2.789,1.17l0.5,0.5c0.391,0.391,1.023,0.391,1.414,0l0.5-0.5 C14.719,4.698,17.281,4.702,18.791,6.205z" />
                    </svg>
                </a>
            </div>
            <p class="pt-1 text-gray-800 font-bold text-xl">{{ Format::priceWithTaxAndCurrency($product->firstReference->price) }}</p>
        </div>
    </div>
    @empty
    <p>Sorry, no products can be displayed for the moment!</p>
    @endforelse
    <div class="mt-6">
        {{ $products->links() }}
    </div>
</div>