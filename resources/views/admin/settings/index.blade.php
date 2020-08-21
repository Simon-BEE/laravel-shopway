@extends('layouts.back')

@section('meta-title')
    {{ __('Settings') }}
@endsection

@section('breadcrumb')
    <x-back.breadcrumb-item route="{{ route('admin.settings.index') }}" label="{{ __('Settings') }}" active/>
@endsection

@section('content')
    <x-modal title="Are you sure ?">
        <p>{{ __('Are you sure you want to process this action?') }}</p>
        <p class="text-sm text-red-500 inline-flex items-center">
            <span class="mdi mdi-alert mr-2 text-lg"></span>
            {{ __('Some actions can be dangerous!') }}
        </p>
        <div class="mt-5 flex justify-end">
            <x-form.button classDiv="none" class="p-2 mr-3 bg-gray-200 text-gray-700 hover:bg-gray-300" x-on:click="isDialogOpen = false">{{ __('Cancel') }}</x-form.button>
            <x-form.form-button action="#" method="POST" class="p-2 rounded bg-red-500 text-white hover:bg-red-600" x-ref="modalConfirm">
                {{ __('I want to do this') }}
            </x-form.form-button>
        </div>
    </x-modal>

    <h3 class="text-gray-700 text-3xl font-medium">{{ __('Settings Panel') }}</h3>

    <div class="mt-6 flex flex-col md:flex-row justify-between">
        <article class="bg-gray-300 p-4">
            <h4 class="text-xl text-center uppercase font-semibold">Backup</h4>
            <p class="text-center my-3">
                <a href="{{ route('admin.settings.backup.index') }}" class="text-blue-500 hover:underline">Show all backup</a>
            </p>
            <button type="button" class="bg-gray-200 text-gray-700 inline-flex flex-col justify-center items-center p-4 mb-2 transition-colors duration-200 hover:bg-gray-700 hover:text-blue-300" data-route="{{ route('admin.settings.backup.database') }}" x-on:click="setAction($event); isDialogOpen = true;">
                <span class="mdi mdi-database-sync mb-2 text-3xl"></span>
                <p>{{ __('Backup database') }}.</p>
            </button>
        </article>
    </div>

    <div class="mt-6 bg-gray-100 p-4">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis sapiente eveniet dignissimos quasi magni cupiditate perferendis distinctio ipsa laudantium exercitationem? Velit laudantium dolorem vel ipsa beatae quia voluptatem minima perferendis! Dolor consectetur culpa laboriosam neque vel quisquam pariatur sequi quo beatae odio enim voluptates cumque expedita debitis asperiores corrupti molestias molestiae, consequatur nesciunt tempore commodi in. Atque incidunt earum minima aliquid quam at quibusdam dolorum reprehenderit officia odio quo illo perspiciatis commodi nobis corrupti, magni fugiat sed quas pariatur labore hic quod. Exercitationem velit dolore placeat iusto, amet necessitatibus, adipisci delectus officia cupiditate natus, fugit in eveniet accusantium modi architecto ipsum. Voluptas vel, distinctio quia labore maiores sit ducimus animi officiis unde expedita eius, soluta repellat error id magnam repellendus? Tenetur, voluptatum! Iusto deserunt cumque officia totam ratione voluptatum perferendis, quis sint impedit aliquam accusantium, ea, eius aut porro ex ipsa inventore odio. Quidem, maiores itaque! Veniam rem sunt expedita.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, eaque rerum beatae, iste exercitationem repellendus esse optio laborum in voluptates eum voluptatibus veritatis ut possimus necessitatibus. Ipsam repellat officiis numquam consequatur ea, amet explicabo sunt est facere voluptatum nemo temporibus voluptas animi, consectetur iure exercitationem ad dolores iusto dolorem suscipit. Nostrum inventore unde quam nulla corrupti aspernatur, iste sint quidem eos. Enim soluta nostrum impedit quibusdam dolores sequi quo accusamus est id perferendis, quia molestiae deleniti vitae, adipisci non dicta vel totam omnis eum voluptate, numquam natus aliquam modi. Nostrum quidem possimus deserunt praesentium quisquam, neque nihil, animi deleniti iure natus, cum accusantium itaque culpa. Maiores quod consequuntur facere illum quam esse aperiam perferendis facilis expedita autem officiis porro, possimus unde ad nostrum mollitia at reiciendis. Iste blanditiis exercitationem modi tempore. Nobis perferendis asperiores assumenda corporis. Natus, esse molestias deleniti commodi iusto mollitia minus sapiente eius, earum, nostrum repellat accusamus dolorum ipsum modi facilis hic vitae! Sit repellendus laborum, nam voluptatem saepe commodi iusto soluta quam animi magnam libero accusamus obcaecati, est, necessitatibus deserunt! Quos ratione error illo odit reiciendis ad hic odio libero iste, maiores eveniet, unde quasi dolore aut doloribus porro fuga id esse quo qui praesentium soluta.</p>
    </div>
@endsection

@section('extra-js')
    <script>
        function setAction(event) {
            document.querySelector('.modal-element form').action = event.currentTarget.getAttribute('data-route');
        }
    </script>
@endsection
