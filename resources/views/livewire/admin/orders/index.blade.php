<div class="mt-4">
    {{-- filter --}}
    <div class="mt-3 flex flex-col sm:flex-row">
        <div class="flex">
            {{-- nb results --}}
            <div class="relative">
                <select class="appearance-none h-full rounded-l border block appearance-none w-full bg-white border-gray-400 text-gray-700 py-2 px-4 pr-8 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" wire:model="perPage">
                    <option>10</option>
                    <option>20</option>
                    <option>50</option>
                </select>

                <div class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700">
                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                        <path d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"></path>
                    </svg>
                </div>
            </div>
        </div>

        {{-- search --}}
        <div class="block relative mt-2 sm:mt-0">
            <span class="absolute inset-y-0 left-0 flex items-center pl-2">
                <svg viewBox="0 0 24 24" class="h-4 w-4 fill-current text-gray-500">
                    <path d="M10 4a6 6 0 100 12 6 6 0 000-12zm-8 6a8 8 0 1114.32 4.906l5.387 5.387a1 1 0 01-1.414 1.414l-5.387-5.387A8 8 0 012 10z"></path>
                </svg>
            </span>

            <input placeholder="Search" name="search" wire:model.debounce.500ms="searchTerm" class="appearance-none rounded-r rounded-l sm:rounded-l-none border border-gray-400 border-b block pl-8 pr-6 py-2 w-full bg-white text-sm placeholder-gray-400 text-gray-700 focus:bg-white focus:placeholder-gray-600 focus:text-gray-700 focus:outline-none">
        </div>
    </div>

    <div class="-mx-4 sm:-mx-8 px-4 sm:px-8 py-4 overflow-x-auto">
        <div class="inline-block min-w-full shadow rounded-lg overflow-hidden">
            <table class="min-w-full leading-normal">
                <thead>
                    <tr>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('id')"
                        >
                            # <span class="ml-1 text-xs">{!! Filter::iconDirection($sortField, 'id', $sortAsc) !!}</span>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('total')"
                        >
                            Amount <span class="ml-1 text-xs">{!! Filter::iconDirection($sortField, 'total', $sortAsc) !!}</span>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('created_at')"
                        >
                            Created at <span class="ml-1 text-xs">{!! Filter::iconDirection($sortField, 'created_at', $sortAsc) !!}</span>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider""
                        >
                            Status
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                        <tr wire:key="{{ $loop->index }}">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                {{ $order->id }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm font-semibold">
                                {{ Format::priceWithCurrency($order->total) }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-xs">
                                {{ Format::date($order->created_at, 'd/m/Y H:i') }}
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <span class="rounded-lg p-3 bg-gray-200 text-{{ $order->state->color }}-500">{{ $order->status }}</span>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex">
                                <a href="{{ route('admin.orders.show', $order) }}" class="bg-gray-200 p-2 rounded inline-flex text-green-400 hover:text-green-900 mr-2">
                                    <span class="text-lg mdi mdi-eye"></span>
                                </a>
                                <a href="#" class="bg-gray-200 p-2 rounded inline-flex text-orange-400 hover:text-orange-600 mr-2">
                                    <span class="text-lg mdi mdi-pencil-outline"></span>
                                </a>
                                <button type="button" class="bg-gray-200 p-2 rounded inline-flex text-red-400 hover:text-red-600">
                                    <span class="text-lg mdi mdi-delete-outline" data-route="#" x-on:click="setAction($event); isDialogOpen = true;"></span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="p-6 text-center">No orders found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-5 py-5 bg-white flex items-center justify-center">
                {{ $orders->links('vendor.pagination.livewire-tailwind') }}
            </div>
        </div>
    </div>
</div>