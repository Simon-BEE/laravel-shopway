@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
    Your cart
@endsection

@section('content')

<section class="my-12 min-h-full px-6 relative">
    <div class="w-full container mx-auto flex flex-wrap items-center justify-between mt-0 px-2 py-3">
        <a class="uppercase tracking-wide no-underline hover:no-underline font-bold text-gray-800 text-xl " href="#">
            Cart
        </a>
    </div>
    <section class="flex justify-center my-6">
        <div class="flex flex-col w-full p-8 text-gray-800 bg-white shadow-lg">
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
                    @forelse (session('cart') as $id => $item)
                    <tr>
                        <td class="hidden md:table-cell">
                            <a href="#">
                                <img src="https://limg.app/i/Calm-Cormorant-Catholic-Pinball-Blaster-yM4oub.jpeg" class="w-20 rounded" alt="Thumbnail">
                            </a>
                        </td>
                        <td>
                            <a href="{{ ProductHelper::getRouteByReference($id) }}" class="hover:underline mr-2">
                                {{ $item['name'] }}
                            </a>
                            <x-form.form-button action="#" method="DELETE">
                                <span class="mdi mdi-delete ml-2"></span>
                            </x-form.form-button>
                        </td>
                        <td class="justify-center md:justify-end md:flex">
                            <div class="w-20 h-10">
                                <div class="relative flex flex-row w-full h-8">
                                    <input type="number" value="{{ $item['quantity'] }}"
                                        class="w-full font-semibold rounded text-center text-gray-700 bg-gray-200 outline-none focus:outline-none hover:text-black focus:text-black" />
                                </div>
                            </div>
                        </td>
                        <td class="hidden text-right md:table-cell">
                            <span class="text-sm lg:text-base font-medium">
                            {{ $item['price'] }}€
                            </span>
                        </td>
                        <td class="text-right">
                            <span class="text-sm lg:text-base font-medium">
                            {{ $item['quantity'] * $item['price'] }}€
                            </span>
                        </td>
                    </tr>
                    @empty
                        <tr>
                            No product added to cart.
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <hr class="pb-6 mt-6">
            <div class="my-4 mt-6 -mx-2 lg:flex">
              <div class="lg:px-2 lg:w-1/2">
                <div class="p-4 bg-gray-100 rounded">
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
                <div class="p-4 mt-6 bg-gray-100 rounded">
                    <h3 class="ml-2 font-bold uppercase">Instruction for seller</h3>
                </div>
                <div class="p-4">
                  <p class="mb-4 italic">If you have some information for the seller you can leave them in the box below</p>
                  <textarea class="w-full h-24 p-2 bg-gray-100 rounded"></textarea>
                </div>
              </div>
              <div class="lg:px-2 lg:w-1/2">
                <div class="p-4 bg-gray-100 rounded">
                    <h3 class="ml-2 font-bold uppercase">Order Details</h3>
                </div>
                <div class="p-4">
                  <p class="mb-6 italic">Shipping and additionnal costs are calculated based on values you have entered</p>
                    <div class="flex justify-between border-b">
                        <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">Subtotal</div>
                        <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">148.53€</div>
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
                        <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900"> 26.55€</div>
                    </div>
                    <div class="flex justify-between pt-4 border-b">
                        <div class="lg:px-4 lg:py-2 m-2 text-lg font-semibold text-center text-gray-800">Total</div>
                        <div class="lg:px-4 lg:py-2 m-2 lg:text-lg font-bold text-center text-gray-900">179.30€</div>
                    </div>
                    <a href="#">
                      <button class="flex justify-center items-center w-full px-10 py-3 mt-6 font-medium text-white uppercase bg-gray-800 rounded-full shadow item-center hover:bg-gray-700 focus:shadow-outline focus:outline-none">
                        <span class="mdi mdi-credit-card-check-outline mr-2 text-2xl"></span>
                        <span class="ml-2 mt-5px">Procceed to checkout</span>
                      </button>
                    </a>
                </div>
              </div>
            </div>
          </div>
        </div>
    </section>
</section>


@endsection
