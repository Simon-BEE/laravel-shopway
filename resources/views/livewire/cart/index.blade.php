<div class="flex-1">
    <table class="w-full text-sm lg:text-base" cellspacing="0">
        <thead>
            <tr class="h-12 uppercase">
                <th class="hidden md:table-cell"></th>
                <th class="text-left">Product</th>
                <th class="lg:text-right text-left pl-5 lg:pl-0">Quantity</span></th>
                <th class="hidden text-right md:table-cell">Unit price</th>
                <th class="text-right">Total price</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($cartProducts as $productOptionId => $productOption)
                @foreach ($productOption as $productOptionSizeId => $productOptionSize)
                    <livewire:cart.item :productOptionId="$productOptionId" :productOptionSizeId="$productOptionSizeId" :productOption="$productOptionSize" :key="$productOptionId + $productOptionSizeId"/>
                @endforeach
            @empty
                <tr>
                    <td colspan="100%" class="text-center p-4 bg-gray-200">
                        &rarr; No product added to cart.
                    </td>
                </tr>
            @endforelse
        </tbody>
    </table>
    <hr class="pb-6 mt-6">
    @if (count($cartProducts) > 0)
        @auth
        <div class="mb-4 mt-6 -mx-2 lg:flex">
            <div class="lg:px-2 lg:w-1/2">
                <div class="p-2 bg-gray-100 rounded">
                    <h3 class="ml-2 font-bold uppercase">Coupon Code</h3>
                </div>
                <div class="p-4">
                    <p class="mb-4 italic">If you have a coupon code, please enter it in the box below</p>
                    <form action="" method="POST">
                        <div class="flex">
                            <x-form.input
                                classDiv=""
                                type="text"
                                name="coupon"
                                placeholder="Coupon name"
                            />
                            <x-form.button classDiv="flex ml-2">Apply</x-form.button>
                        </div>
                    </form>
                </div>
                <div class="p-2 mt-6 bg-gray-100 rounded">
                    <h3 class="ml-2 font-bold uppercase">Instruction for seller</h3>
                </div>
                <div class="p-4">
                <p class="mb-4 italic">If you have some information for the seller you can leave them in the box below</p>
                <textarea class="w-full h-24 p-2 bg-gray-100 rounded"></textarea>
                </div>
            </div>
            <div class="lg:px-2 lg:w-1/2">
                <div class="p-2 bg-gray-100 rounded">
                    <h3 class="ml-2 font-bold uppercase">Order Details</h3>
                </div>
                <div class="p-4">
                <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>
                    <div class="flex justify-between border-b">
                        <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">Subtotal</div>
                        <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">{{ $totalWithoutTax }}</div>
                    </div>
                    {{-- <div class="flex justify-between pt-4 border-b">
                        <div class="flex items-center lg:px-4 m-2 text-lg font-semibold text-gray-800">
                            Coupon "90off"
                            <x-form.form-button action="#" method="DELETE">
                                <span class="mdi mdi-delete ml-2"></span>
                            </x-form.form-button>
                        </div>
                        <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-green-700">-134.77€</div>
                    </div>
                    <div class="flex justify-between pt-4 border-b">
                        <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">New Subtotal</div>
                        <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">142.75€</div>
                    </div> --}}
                    <div class="flex justify-between pt-4 border-b">
                        <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">Tax</div>
                        <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">{{ $totalTax }}</div>
                    </div>
                    @if ($shippingFees)
                        <div class="flex justify-between pt-4 border-b">
                            <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">Shipping Fees</div>
                            <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">{{ $shippingFees }}</div>
                        </div>
                    @endif
                    <div class="flex justify-between pt-4 border-b">
                        <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">Total</div>
                        <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">{{ $totalWithTax }}</div>
                    </div>
                    <a href="{{ route('checkout.index') }}" data-turbolinks="false">
                        <button class="flex justify-center items-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                            <span class="mdi mdi-credit-card-check-outline mr-2 text-2xl"></span>
                            <span class="ml-2 mt-5px">Procceed to checkout</span>
                        </button>
                    </a>
                </div>
            </div>
        </div>
        @else
        <div class="my-5 text-center">
            Please <a class="text-blue-500 hover:underline" href="{{ route('login') }}">sign in</a> or <a class="text-blue-500 hover:underline" href="{{ route('register') }}">sign up</a> before continue.
        </div>
        @endauth
    @endif
  </div>
