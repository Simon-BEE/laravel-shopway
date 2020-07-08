<div class="mt-2">
    <div class="flex justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">List of categories</h3>
        <div class="flex">
            <button type="button" class="flex items-center mr-3 p-2 rounded text-white bg-blue-600 hover:bg-blue-500" x-on:click="formModalOpen = true">
                <span class="mdi mdi-plus mr-2"></span>
                Create a category
            </button>
        </div>
    </div>
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
                            wire:click="sortBy('name')"
                        >
                            Name <span class="ml-1 text-xs">{!! $sortAsc ? '&darr;' : '&uarr;' !!}</span>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider cursor-pointer"
                            wire:click="sortBy('created_at')"
                        >
                            Created at
                        </th>
                        </th>
                        <th class="px-5 py-3 border-b-2 border-gray-200 bg-gray-100 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($categories as $category)
                        <tr wire:key="{{ $loop->index }}">
                            <td class="px-5 py-5 border-b border-gray-200 bg-white">
                                <div class="flex items-center">
                                    <div class="ml-3 flex flex-col">
                                        <div class="text-gray-900 whitespace-no-wrap" x-data="{ 
                                            isEditing: false, 
                                            {{-- selectText: function() {
                                                console.log(this.$refs.textInput)
                                                const textInput = this.$refs.textInput;
                                                textInput.focus();
                                                textInput.select();
                                            } --}}
                                        }">
                                            <span x-show="!isEditing" x-on:click="
                                                isEditing = true;
                                                {{-- $nextTick(() => selectText()); --}}
                                            ">
                                                {{ $category->name }}
                                            </span>
                                            <div x-show.transition="isEditing">
                                                <x-form.input
                                                    label=""
                                                    type="text"
                                                    name="name"
                                                    placeholder="Product's name"
                                                    value="{{ old('name') ?? $category->name }}"
                                                    helper="Enter to save, Esc to {{ __('Cancel') }}"
                                                    required
                                                    wire:keydown.enter="updateCategory({{ $category->id }}, $event.target.value)"
                                                    {{-- x-ref="textInput" --}}
                                                    x-on:keydown.enter="isEditing = false"
                                                    x-on:keydown.escape="isEditing = false"
                                                    x-on:click.away="isEditing = false"
                                                />
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm">
                                <p class="text-gray-900 whitespace-no-wrap">
                                    {{ Format::date($category->created_at) }}
                                </p>
                            </td>
                            <td class="px-5 py-5 border-b border-gray-200 bg-white text-sm flex md:table-cell">
                                <button type="button">
                                    <span class="text-lg mdi mdi-delete-outline bg-gray-200 p-2 rounded inline-flex text-red-400 hover:text-red-600" data-route="{{ route('admin.products.categories.destroy', $category) }}" x-on:click="setAction($event); isDialogOpen = true;"></span>
                                </button>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="100%" class="p-6 text-center">No categories found.</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
            <div class="px-5 py-5 bg-white flex items-center justify-center">
                {{ $categories->links('vendor.pagination.livewire-tailwind') }}
            </div>
        </div>
    </div>
</div>