<div class="bg-white p-4 mt-6 relative">
    <x-form.input-icon
        label="Define a product option's price"
        type="text"
        name="price"
        placeholder="Product option's price"
        value="{{ old('price') ?? $productOption->price }}"
        helper="Must be in cents and without currency and tax. (Price with tax: {{ Format::priceWithTaxAndCurrency($productOption->price) }})"
        icon="mdi-home-currency-usd"
        required
        wire:model.lazy="price"
    />
    <div class="flex flex-col md:flex-row justify-between mt-3">
        <div class="w-full md:w-5/12">
            <x-form.input-icon
                label="Define a product option's weight"
                type="text"
                name="weight"
                placeholder="Product option's weight"
                value="{{ old('weight') ?? $productOption->weight }}"
                helper="Must be in grams"
                icon="mdi-weight"
                required
                wire:model.lazy="weight"
            />
        </div>
        <div class="w-full md:w-5/12">
            <x-form.input-icon
                label="Define a product option's quantity"
                type="text"
                name="quantity"
                placeholder="Product option's quantity"
                value="{{ old('quantity') ?? $productOption->quantity }}"
                icon="mdi-package-variant"
                required
                wire:model.lazy="quantity"
            />
        </div>
    </div>

    <h4 class="text-lg font-semibold mb-3">{{ __('Specific feature') }}</h4>

    <x-form.select 
        label="Choose a color"
        name="color"
        required
        wire:change="updateColor($event.target.value)"
    >
        @foreach ($colors as $color)
            <option value="{{ $color->id }}" {{ $productOption->color->id === $color->id ? 'selected' : '' }}>{{ __($color->name) }}</option>
        @endforeach
    </x-form.select>
    <x-form.select 
        label="Choose a material"
        name="material"
        required
        wire:change="updateMaterial($event.target.value)"
    >
        @foreach ($materials as $material)
            <option value="{{ $material->id }}" {{ $productOption->material->id === $material->id ? 'selected' : '' }} >{{ __($material->name) }}</option>
        @endforeach
    </x-form.select>
    {{-- <x-form.select 
        label="Choose sizes available"
        name="sizes[]"
        required
        multiple
    >
        @foreach ($sizes as $size)
            <option value="{{ $size->id }}" {{ $productOption->hasSize($size->id) ? 'selected' : '' }}>{{ __($size->name) }}</option>
        @endforeach
    </x-form.select> --}}


    <div class="">
        <p class="text-gray-700 mb-2">Select sizes available</p>
        <div class="flex flex-wrap">
            @foreach ($sizes as $size)
                <x-form.checkbox 
                    name="categories[{{ $size->id }}]"
                    label="{{ $size->name }}"
                    value="{{ $size->id }}" 
                    checked="{{ $productOption->hasSize($size->id) ? true : false }}"
                    wire:change="updateSize({{ $size->id }})"
                    wire:poll.2500ms="$refresh"
                />
            @endforeach
        </div>
    </div>

    <h4 class="text-lg font-semibold mb-3">Media</h4>

    <section class="media">
        <div class="flex justify-between w-full items-center mb-2">
            <label class="label text-gray-700" for="labelImages">
                {{ __('Remove or add images about your product option') }}
            </label>
            <button type="button" class="hidden p-2 text-red-500 rounded hover:bg-gray-200" id="resetImages" title="{{ __('Reset images') }}">
                <span class="mdi mdi-delete-outline"></span>
            </button>
        </div>
        <div class="flex flex-wrap justify-center my-4 relative" id="imagesPreview">
            @forelse ($images as $image)
                <article class="flex flex-col relative">
                    <img src="{{ $productOption->imagePath($image->filename) }}" alt="{{ $image->filename }}">
                    <div class="flex justify-around">
                        @if (!$image->is_main)
                            <button type="button" class="text-sm text-red-500 -mt-3 justify-center hover:underline" wire:click="$emit('removeProductImage', {{ $image->id }})">
                                <span class="mdi mdi-delete-outline mr-2"></span>
                                {{ __('Remove') }}
                            </button>
                        @endif
                        @if ($images->count() > 1)
                            <x-form.radio
                                classDiv="absolute top-0 right-0 mt-1 rounded bg-white bg-opacity-25 px-2 py-1 shadow-sm mr-4"
                                name="is_main"
                                label=""
                                value="{{ $productOption->id }}"
                                checked="{{ $image->is_main }}"
                                title="Set as main image"
                                wire:change="$emit('setImageAsMain', {{ $image->id }})"
                            />
                        @endif
                    </div>
                </article>
            @empty
                <p class="my-6">{{ __('No images found') }}.</p>
            @endforelse
        </div>
        <div class="w-1/2 mx-auto">
            <label class="block text-gray-700 text-sm font-bold mb-2" for="imagesInput">
                <div class="border border-dashed border-gray-400 rounded-lg px-8 py-12 flex flex-col items-center justify-center cursor-pointer text-gray-500 mt-3">
                    <span class="">
                        <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="45" height="45" viewBox="0 0 17 17">
                            <g>
                            </g>
                                <path d="M1 1v15h15v-15h-15zM15 15h-13v-2h13v2zM2 12v-10h13v10h-13zM14.203 10.165l-0.697 0.717-2.417-2.349-1.554 1.676-2.486-4.415-3.401 4.975-0.826-0.564 4.31-6.303 2.604 4.622 1.317-1.422 3.15 3.063z" fill="currentColor"></path>
                            </svg>
                    </span>
                    <span class="font-semibold text-sm mb-3">{{ __('Click to upload your file') }}</span>
                    <span class="font-light text-xs mb-3">{{ __('PNG, or JPG are allowed (2MB max)') }}</span>
                    <input type="file" class="hidden" accept="image/*" name="pictures[]" id="imagesInput" wire:model="pictures"  multiple="">
                </div>
            </label>
        </div>
        @error('pictures.*') <span class="text-red-500">{{ $message }}</span> @enderror
    </section>
</div>
