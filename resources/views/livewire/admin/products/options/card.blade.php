<div class="w-full flex justify-between p-3 border-l-4 border-blue-500 mb-3">
    <div class="w-1/12">
        <img src="{{ $productOption->main_image_path }}" alt="" class="w-20 h-20 object-cover rounded shadow">
    </div>
   <p>{{ $productOption->price }}</p>
   <p>{{ $productOption->quantity }}</p>
</div>
