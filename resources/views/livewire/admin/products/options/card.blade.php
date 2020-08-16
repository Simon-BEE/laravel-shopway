<div class="w-full flex justify-between items-center p-3 border border-gray-200 rounded mb-3">
    <div class="w-6/12 flex items-center">
        <div class="w-1/12">
            <img src="{{ $productOption->main_image_path }}" alt="" class="w-20 h-20 object-cover rounded shadow">
        </div>
        <div class="ml-4">
            <p class="font-semibold">
                Option n°{{ $productOption->id }} 
                <span class="p-2 ml-2 rounded {{ $productOption->classname }}">
                    {{ $productOption->color->name }} / {{ $productOption->material->name }}
                </span>
            </p>
            <p class="mt-3 text-sm text-gray-500">{{ __('Sizes available') }}: {{ $productOption->sizes_available_formatted }}</p>
        </div>
    </div>
    <div class="w-3/12 text-sm">
            <p class="">
                {{ __('Price') }}: 
                <span class="font-semibold">{{ Format::priceWithCurrency($productOption->price) }}</span>(HT)/
                <span class="font-semibold">{{ Format::priceWithTaxAndCurrency($productOption->price) }}</span>
            </p>
            <p>{{ __('Quantity') }}: {{ $productOption->quantity }}</p>
    </div>
    <div class="w-1/12">
        <a href="{{ route('admin.products.options.edit', [$product, $productOption]) }}" class="bg-transparent p-2 rounded inline-flex text-orange-400 hover:bg-gray-200 hover:text-orange-600 mr-2">
            <span class="text-lg mdi mdi-pencil-outline"></span>
        </a>
        <button type="button" class="bg-transparent p-2 rounded inline-flex text-red-400 hover:bg-gray-200 hover:text-red-600">
            <span class="text-lg mdi mdi-delete-outline" data-route="{{ route('admin.products.options.destroy', [$product, $productOption]) }}" x-on:click="setAction($event); isDialogOpen = true;"></span>
        </button>
    </div>
</div>
