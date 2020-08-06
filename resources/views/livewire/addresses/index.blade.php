<section class="flex flex-wrap justify-between">
    @forelse ($addresses as $address)
        <article 
            class="p-2 lg:w-5/12 rounded relative cursor-pointer hover:bg-gray-100 " 
            title="{{ __('Select this address') }}" 
            wire:click="$emit('setAddressAsMain', {{ $address->id }})"
        >
            <div class="h-full flex sm:flex-row flex-col items-center sm:justify-start justify-center text-center sm:text-left">
                <div class="flex flex-col justify-center p-4">
                    <span class="mdi mdi-map-marker text-4xl"></span>
                </div>
                <div class="flex-grow sm:pl-8">
                    <h3 class="title-font font-medium text-lg text-gray-900">
                        {{ $address->name }} 
                        @if($address->professionnal)<span class="text-xs text-gray-500 ml-1">{{ $address->company }}</span>@endif
                    </h3>
                    <h4 class="text-gray-500 mb-3 text-sm">{{ $address->city }}, {{ $address->country->name }}</h4>
                    <p class="mb-2">{{ $address->full_name }}</p>
                    <p class="mb-4">{{ $address->full_address }}</p>
                </div>
            </div>
            <div class="absolute top-0 right-0 mr-1 mt-1">
                @if (!$address->is_main)
                <button type="button" class="flex" title="{{ __('Remove') }}" >
                    <span class="mdi mdi-delete-outline p-2 rounded text-red-500 hover:bg-gray-200" data-route="{{ route('users.addresses.destroy', $address) }}" x-on:click.stop="setAction($event); isDialogOpen = true;"></span>
                </button>
                @endif
            </div>
            @if ($address->is_main)
                <span class="absolute bottom-0 right-0 mr-2">
                    <span class="mdi mdi-check-circle-outline text-gray-700 text-2xl"></span>
                </span>
                <div class="h-full w-1 bg-gray-700 absolute bottom-0 left-0"></div>
            @endif
        </article>
    @empty
        <article class="w-full p-4">
            <p>{{ __('No addresses found') }}. <a href="{{ route('users.addresses.create') }}" class="text-blue-500 hover:underline">{{ __('Please add at least one') }}</a>.</p>
        </article>
    @endforelse
</section>