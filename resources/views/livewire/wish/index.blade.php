
<div class="flex flex-col">
    <div class="-my-2 py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="align-middle inline-block min-w-full shadow overflow-hidden sm:rounded-lg border-b border-gray-200">
            <table class="min-w-full">
                <tbody class="bg-white">
                    @forelse ($wishes as $wish)
                    <tr>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200">
                            <a href="{{ route('products.show', $wish->product) }}" class="flex items-center">
                                <div class="flex-shrink-0 h-10 w-10">
                                    <img class="h-10 w-10 rounded-full" src="{{ $wish->product->mainImagePath }}" alt="{{ $wish->product->name }}" />
                                </div>
                                <div class="ml-4">
                                    <div class="text-sm leading-5 font-medium text-gray-900">
                                        {{ $wish->product->name }}
                                    </div>
                                    <div class="text-sm leading-5 text-gray-500">
                                        {{ $wish->product->name }}
                                    </div>
                                </div>
                            </a>
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap border-b border-gray-200 text-sm leading-5 text-gray-500">
                            {{ Format::priceWithTaxAndCurrency($wish->product->price) }}
                        </td>
                        <td class="px-6 py-4 whitespace-no-wrap text-right border-b border-gray-200 text-sm leading-5 font-medium">
                            <button href="#" class="text-xl text-blue-500 hover:text-blue-900 mr-6" title="Add to cart" wire:click="addToCart({{ $wish->product->id }})">
                                <span class="mdi mdi-cart-outline"></span>
                            </button>
                            <button href="#" class="text-xl text-red-500 hover:text-red-900" title="Remove from wishlist" wire:click="removeFromWishlist({{ $wish->product->id }})">
                                <span class="mdi mdi-delete-outline"></span>
                            </button>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <div class="text-center w-full p-12">
                            {{ __('Nothing in your wishlist!') }}
                        </div>
                    </tr>
                    @endforelse
                </tbody>

            </table>
        </div>
    </div>
</div>
