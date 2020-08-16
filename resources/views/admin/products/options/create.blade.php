@extends('layouts.back')

@section('meta-title')
    Add an option
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.products.index') }}" label="List of products"/>
    <x-back.breadcrumb-item route="{{ route('admin.products.edit', $product) }}" label="{{ $product->name }}"/>
    <x-back.breadcrumb-item route="{{ route('admin.products.options.create', $product) }}" label="Add an option" active/>
@endsection

@section('content')

    <div class="flex justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">Add an option</h3>
    </div>
    <div class="mt-6 p-4 bg-white">
        <form action="{{ route('admin.products.options.store', $product) }}" method="post" class="productForm" enctype="multipart/form-data">
            @csrf
            <h4 class="text-lg font-semibold mb-3">Details</h4>

            <input type="hidden" name="" value="" class="inputHidden">
            
            <x-form.input-icon
                label="Define a product's price"
                type="text"
                name="price"
                placeholder="Product's price"
                value="{{ old('price') }}"
                helper="Must be in cents and without currency and tax."
                icon="mdi-home-currency-usd"
                required
            />
            <div class="flex flex-col md:flex-row justify-between mt-3">
                <div class="w-full md:w-5/12">
                    <x-form.input-icon
                        label="Define a product's weight"
                        type="text"
                        name="weight"
                        placeholder="Product's weight"
                        value="{{ old('weight') }}"
                        helper="Must be in grams"
                        icon="mdi-weight"
                        required
                    />
                </div>
                <div class="w-full md:w-5/12">
                    <x-form.input-icon
                        label="Define a product's quantity"
                        type="text"
                        name="quantity"
                        placeholder="Product's quantity"
                        value="{{ old('quantity') }}"
                        icon="mdi-package-variant"
                        helper="Product will be offline when quantity is less than 2."
                        required
                    />
                </div>
            </div>

            <h4 class="text-lg font-semibold mb-3">{{ __('Specific feature') }}</h4>

            <x-form.select 
                label="Choose a color"
                name="color"
                required
            >
                @foreach ($colors as $color)
                    <option value="{{ $color->id }}">{{ __($color->name) }}</option>
                @endforeach
            </x-form.select>
            <x-form.select 
                label="Choose a material"
                name="material"
                required
            >
                @foreach ($materials as $material)
                    <option value="{{ $material->id }}">{{ __($material->name) }}</option>
                @endforeach
            </x-form.select>
            <x-form.select 
                label="Choose sizes available"
                name="sizes[]"
                required
                multiple
            >
                @foreach ($sizes as $size)
                    <option value="{{ $size->id }}">{{ __($size->name) }}</option>
                @endforeach
            </x-form.select>

            <h4 class="text-lg font-semibold mb-3">Media</h4>

            <section class="media">
                <div class="flex justify-between w-full items-center mb-2">
                    <label class="label text-gray-700" for="labelImages">
                        Add few images about your product option
                    </label>
                    <button type="button" class="hidden p-2 text-red-500 rounded hover:bg-gray-200" id="resetImages" title="{{ __('Reset images') }}">
                        <span class="mdi mdi-delete-outline"></span>
                    </button>
                </div>
                <div class="flex flex-wrap justify-center my-4 hidden relative" id="imagesPreview">
                    <!-- Images previews -->
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
                            <input type="file" class="hidden" accept="image/*" name="images[]" id="imagesInput" multiple="">
                        </div>
                    </label>
                </div>
            </section>
            

            <div class="mt-6">
                <hr>
                <div class="flex justify-end">
                    <x-form.button class="p-2 mr-3 bg-orange-500 text-white hover:bg-orange-600" type="button" x-on:click="goToAnotherForm(event)">
                        {{ __('Save and add a new option') }}
                    </x-form.button>
                    <x-form.button>
                        {{ __('Save and quit') }}
                    </x-form.button>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('extra-js')
    <script>
        Turbolinks.visit(window.location.reload());

        function goToAnotherForm(e) {
            e.preventDefault();
            const form = document.querySelector('.productForm');
            const inputHidden = document.querySelector('.inputHidden');
            inputHidden.name = "another_form";
            inputHidden.value = true;

            form.submit();
        }
    </script>
@endsection