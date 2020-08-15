<div class="bg-white p-4 mt-6 relative">
    <button type="button" class="absolute right-0 mr-3 p-2 rounded inline-flex text-red-400 hover:bg-gray-200 hover:text-red-600">
        <span class="text-lg mdi mdi-delete-outline" data-route="{{ route('admin.products.destroy', $product) }}" x-on:click="isDialogOpen = true;"></span>
    </button>

    <form action="#" method="post">
        @csrf
        <h4 class="font-semibold mb-3 text-lg">General informations about product</h4>
        <x-form.input
            label="Define a product's name"
            type="text"
            name="name"
            placeholder="Product's name"
            value="{{ old('name') ?? $name }}"
            helper="A slug will be generated automatically"
            required
            wire:model.lazy="name"
        />
        <x-form.textarea
            label="Describe your product"
            name="description"
            placeholder="Product's description"
            value="{{ old('description') ?? $product->description }}"
            required
            wire:model.lazy="description"
        />
        {{-- <livewire:admin.products.edit-categories :productId="$product->id" /> --}}

        <div class="">
            <p class="text-gray-700 mb-2">Select one or more categories</p>
            <div class="flex flex-wrap">
                @foreach ($categories as $category)
                    <x-form.checkbox 
                        name="categories[{{ $category->id }}]"
                        label="{{ $category->name }}"
                        value="{{ $category->id }}" 
                        checked="{{ $product->hasCategory($category) ? true : false }}"
                        wire:change="updateCategories({{ $category->id }})"
                        wire:poll.2500ms="$refresh"
                    />
                @endforeach
            </div>
        </div>

        @foreach ($product->product_options as $option)
            <livewire:admin.products.options.card :productOption="$option" :key="$option->id" />
        @endforeach
        
    </form>
</div>