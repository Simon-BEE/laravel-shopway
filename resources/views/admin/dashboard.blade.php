@extends('layouts.back')

@section('meta-title')
    Dashboard
@endsection

@section('content')
    <h3 class="text-gray-700 text-3xl font-medium">Dashboard</h3>

    <div class="mt-6 flex flex-col md:flex-row justify-between">
        <article class="bg-gray-400 text-gray-700 flex flex-col justify-center items-center p-8 mb-2 md:w-5/12">
            <span class="mdi mdi-basket-fill mb-2 text-3xl"></span>
            <p><span class="font-bold">{{ $orderNotifications->count() }}</span> {{ trans_choice('new orders', 2) }}.</p>
            <p>
                <a href="#" class="text-blue-500 hover:underline">{{ __('Find out more') }}</a>
            </p>
        </article>
        <article class="bg-gray-400 text-gray-700 flex flex-col justify-center items-center p-8 mb-2 md:w-5/12">
            <span class="mdi mdi-account-multiple-plus mb-2 text-3xl"></span>
            <p><span class="font-bold">{{ $userNotifications->count() }}</span> {{ trans_choice('new users', 2) }}.</p>
            <p>
                <a href="#" class="text-blue-500 hover:underline">{{ __('Find out more') }}</a>
            </p>
        </article>
    </div>

    <div class="mt-6 bg-gray-100 p-4">
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Omnis sapiente eveniet dignissimos quasi magni cupiditate perferendis distinctio ipsa laudantium exercitationem? Velit laudantium dolorem vel ipsa beatae quia voluptatem minima perferendis! Dolor consectetur culpa laboriosam neque vel quisquam pariatur sequi quo beatae odio enim voluptates cumque expedita debitis asperiores corrupti molestias molestiae, consequatur nesciunt tempore commodi in. Atque incidunt earum minima aliquid quam at quibusdam dolorum reprehenderit officia odio quo illo perspiciatis commodi nobis corrupti, magni fugiat sed quas pariatur labore hic quod. Exercitationem velit dolore placeat iusto, amet necessitatibus, adipisci delectus officia cupiditate natus, fugit in eveniet accusantium modi architecto ipsum. Voluptas vel, distinctio quia labore maiores sit ducimus animi officiis unde expedita eius, soluta repellat error id magnam repellendus? Tenetur, voluptatum! Iusto deserunt cumque officia totam ratione voluptatum perferendis, quis sint impedit aliquam accusantium, ea, eius aut porro ex ipsa inventore odio. Quidem, maiores itaque! Veniam rem sunt expedita.</p>
        <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Accusantium, eaque rerum beatae, iste exercitationem repellendus esse optio laborum in voluptates eum voluptatibus veritatis ut possimus necessitatibus. Ipsam repellat officiis numquam consequatur ea, amet explicabo sunt est facere voluptatum nemo temporibus voluptas animi, consectetur iure exercitationem ad dolores iusto dolorem suscipit. Nostrum inventore unde quam nulla corrupti aspernatur, iste sint quidem eos. Enim soluta nostrum impedit quibusdam dolores sequi quo accusamus est id perferendis, quia molestiae deleniti vitae, adipisci non dicta vel totam omnis eum voluptate, numquam natus aliquam modi. Nostrum quidem possimus deserunt praesentium quisquam, neque nihil, animi deleniti iure natus, cum accusantium itaque culpa. Maiores quod consequuntur facere illum quam esse aperiam perferendis facilis expedita autem officiis porro, possimus unde ad nostrum mollitia at reiciendis. Iste blanditiis exercitationem modi tempore. Nobis perferendis asperiores assumenda corporis. Natus, esse molestias deleniti commodi iusto mollitia minus sapiente eius, earum, nostrum repellat accusamus dolorum ipsum modi facilis hic vitae! Sit repellendus laborum, nam voluptatem saepe commodi iusto soluta quam animi magnam libero accusamus obcaecati, est, necessitatibus deserunt! Quos ratione error illo odit reiciendis ad hic odio libero iste, maiores eveniet, unde quasi dolore aut doloribus porro fuga id esse quo qui praesentium soluta.</p>
    </div>
@endsection

{{-- @section('extra-js')
    <script>
        if (console.log(!window.location.href.indexOf("admin") > -1);) {
            window.location.reload();
        }
    </script>
@endsection --}}
