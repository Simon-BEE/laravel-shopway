<div>
    <div class="img hover:grow hover:shadow-lg w-72 h-48">
        <img class="w-full h-full object-cover rounded shadow-lg" src="https://picsum.photos/300/300?random={{ mt_rand(1, 15) }}">
    </div>
    <div class="pt-3 flex items-center justify-between">
        <p class="">{{ ucfirst($product->title) }}</p>
        <livewire:wish.add :reference="$product->firstReference" :key="$product->firstReference->id" />
    </div>
    <p class="pt-1 text-gray-800 font-bold text-xl">{{ Format::priceWithTaxAndCurrency($product->firstReference->price) }}</p>
</div>
