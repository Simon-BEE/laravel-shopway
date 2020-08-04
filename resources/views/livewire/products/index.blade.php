<section class="flex flex-col md:flex-row" x-data="{sideFilter: false}">
    <button type="button" class="mr-3 text-2xl text-gray-700 md:flex md:pt-8 md:self-start" x-on:click="sideFilter = !sideFilter" title="Open filter tab">
        <span class="mdi mdi-filter-variant"></span>
    </button>
    <div class="w-1/4 p-2" x-show.transition="sideFilter">
        Lorem ipsum dolor sit amet consectetur, adipisicing elit. Quisquam sunt quo porro sequi voluptas eius eaque cum. Voluptate vel officiis blanditiis consequatur impedit, velit quibusdam nulla fuga, illum dolor error?
    </div>
    <div class="container mx-auto flex items-center flex-wrap pt-4 pb-12">
        <nav id="store" class="w-full z-30 top-0 px-6 py-1" x-data="{searchDiv : true}">
            <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
                <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
                    Store
                </a>
                <div class="flex items-center" id="store-nav-content">
                    <button class="pl-3 text-xl text-gray-700" x-on:click="searchDiv = !searchDiv">
                        <span class="mdi mdi-magnify"></span>
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
            <a href="{{ route('products.show', $product) }}" class="cursor-pointer">
                <livewire:products.card :product="$product" :key="rand() * $product->id" />
            </a>
        </div>
        @empty
        <p>Sorry, no products can be displayed for the moment!</p>
        @endforelse
        <div class="mt-6 flex justify-center w-full">
            {{ $products->links() }}
        </div>
    </div>
</section>
