<tr>
    <td class="hidden md:table-cell">
        <a href="#">
            <img src="{{ $product['photo'] }}" class="w-12 h-12 rounded" alt="Thumbnail">
        </a>
    </td>
    <td>
        <a href="{{ $product['path'] }}" class="hover:underline mr-2">
            {{ $product['name'] }}
        </a>
        <x-form.form-button action="#" method="DELETE" wire:submit.prevent="removeFromCart({{ $productId }})">
            <span class="mdi mdi-delete ml-2"></span>
        </x-form.form-button>
    </td>
    <td class="justify-center md:justify-end md:flex">
        <div class="w-20 h-10">
            <div class="relative flex flex-row w-full h-8">
                <input type="number" value="{{ $quantity }}"
                    class="w-full font-semibold rounded text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black"
                    wire:model.lazy="quantity"
                />
            </div>
        </div>
    </td>
    <td class="hidden text-right md:table-cell">
        <span class="text-sm lg:text-base font-medium">
            {{ Format::priceWithTaxAndCurrency($product['price']) }}
        </span>
    </td>
    <td class="text-right">
        <span class="text-sm lg:text-base font-semibold">
            {{ $productId ? Cart::totalItemWithTax($this->productId) : 0 }}
        </span>
    </td>
</tr>
