@extends('layouts.back')

@section('meta-title')
    Create a product
@endsection

@section('content')

<x-modal title="Add a new reference to this product">
    <x-form.input
        label="Define a reference's name"
        type="text"
        name="name"
        placeholder="Reference's name"
        value="{{ old('name') }}"
        helper="Be clear to recognize with other variants"
        required
    />
    <div class="flex flex-col md:flex-row justify-between">
        <div class="w-2/5">
            <x-form.input
                label="Define a reference's color"
                type="text"
                name="color"
                placeholder="Reference's color"
                value="{{ old('color') }}"
            />
        </div>
        <div class="w-2/5">
            <x-form.input
                label="Define a reference's size"
                type="text"
                name="size"
                placeholder="Reference's size"
                value="{{ old('size') }}"
            />
        </div>
    </div>
    <x-form.input-icon
        label="Define a reference's price"
        type="text"
        name="price"
        placeholder="Reference's price"
        value="{{ old('price') }}"
        helper="Price need to be without tax and currency"
        icon="mdi-cash"
        required
    />
    <div class="flex flex-col md:flex-row justify-between">
        <div class="w-2/5">
            <x-form.input
                label="Define a reference's weight"
                type="text"
                name="weight"
                placeholder="Reference's weight"
                value="{{ old('weight') }}"
                helper="In kilograms."
            />
        </div>
        <div class="w-2/5">
            <x-form.input
                label="Define the reference's quantity"
                type="text"
                name="quantity"
                placeholder="Reference's quantity"
                value="{{ old('quantity') }}"
                required
            />
        </div>
    </div>
    <p class="my-2 text-gray-700 font-semibold">To active this reference you need to add images on next step.</p>
    <div class="mt-5 flex justify-end">
        <x-form.button classDiv="none" class="bg-gray-200 text-gray-700 hover:bg-gray-300" x-on:click="isDialogOpen = false">Cancel</x-form.button>
        <x-form.button classDiv="" type="button" x-ref="modalReference" id="modalSaveRef" x-on:click="isDialogOpen = false">
            Add this reference
        </x-form.button>
    </div>
</x-modal>

    <div class="flex justify-between">
        <h3 class="text-gray-700 text-3xl font-medium">Create a product</h3>
    </div>
    <div class="mt-6 p-4 bg-white">
        <form action="{{ route('admin.products.store') }}" method="post" class="productForm">
            @csrf
            <x-form.input
                label="Define a product's title"
                type="text"
                name="title"
                placeholder="Product's title"
                value="{{ old('title') }}"
                helper="A slug will be generated automatically"
                required
            />
            <x-form.textarea
                label="Describe your product"
                name="description"
                placeholder="Product's description"
                value="{{ old('description') }}"
                required
            />

            <div class="flex flex-col sm:flex-row flex-wrap justify-between my-4 references-box">

            </div>

            <x-form.button type="button" class="bg-orange-500 hover:bg-orange-600" x-on:click="isDialogOpen = true">
                <span class="mdi mdi-plus mr-2"></span>
                Add a reference
            </x-form.button>

            <div class="mt-6">
                <hr>
                <p class="text-right font-semibold text-sm text-gray-700 mt-3">
                    You need to add at least one reference before validate.
                </p>
                <x-form.button>
                    Create a product
                </x-form.button>
            </div>
        </form>
    </div>
@endsection

@section('extra-js')
    <script>
        var counter = 0;
        const productForm = document.querySelector('.productForm')
        const refBox = document.querySelector('.references-box')
        document.getElementById('modalSaveRef').addEventListener('click', () => {
            let inputs = document.querySelectorAll('.modal-content input')
            inputs.forEach((input) => {
                addReferenceInput(input);
                input.value = "";
            })
            addReferenceToBox();
            counter++;
        });

        function addReferenceToBox() {
            let newDiv = document.createElement('div');
            let name = document.querySelector(`input[name="references[${counter}][name]"]`).value;
            let price = document.querySelector(`input[name="references[${counter}][price]"]`).value;
            let color = document.querySelector(`input[name="references[${counter}][color]"]`).value;
            let size = document.querySelector(`input[name="references[${counter}][size]"]`).value;
            let weight = document.querySelector(`input[name="references[${counter}][weight]"]`).value;
            let quantity = document.querySelector(`input[name="references[${counter}][quantity]"]`).value;
            newDiv.id = `refBox_${counter}`;
            newDiv.className = "my-2 border border-gray-200 p-4 relative max-w-sm";
            newDiv.innerHTML =
                    `
                    <p class="text-xl">${name}</p>
                    <div class="flex flex-col sm:flex-row flex-wrap">
                        <p class="mr-2"><span class="font-semibold">Price: </span> ${price}</p>
                        <p class="mr-2"><span class="font-semibold">Color: </span> ${color}</p>
                        <p class="mr-2"><span class="font-semibold">Size: </span> ${size}</p>
                        <p class="mr-2"><span class="font-semibold">Weight: </span> ${weight}</p>
                        <p class="mr-2"><span class="font-semibold">Quantity: </span> ${quantity}</p>
                    </div>
                    `;
            let deleteDiv = document.createElement('div');
            deleteDiv.className = "absolute right-0 top-0 mt-2 mr-1 cursor-pointer";
            deleteDiv.innerHTML = `<button type="button" onclick="deleteThisBox(event, ${counter})" class="mdi mdi-delete text-red-500"></button>`

            newDiv.appendChild(deleteDiv);
            refBox.appendChild(newDiv);
        }

        function addReferenceInput(inputToClone) {
            const newInput = document.createElement('input');
            newInput.id = `${inputToClone.name}_ref_${counter}`;
            newInput.name = `references[${counter}][${inputToClone.name}]`;
            newInput.type = 'hidden';
            newInput.value = inputToClone.value;
            productForm.appendChild(newInput);
        }

        function deleteThisBox(event, id) {
            event.preventDefault();
            document.getElementById('refBox_' + id).remove();
            document.getElementById('name_ref_' + id).remove();
            document.getElementById('color_ref_' + id).remove();
            document.getElementById('size_ref_' + id).remove();
            document.getElementById('price_ref_' + id).remove();
            document.getElementById('weight_ref_' + id).remove();
            document.getElementById('quantity_ref_' + id).remove();
        }
    </script>
@endsection
