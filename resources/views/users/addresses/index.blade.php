@extends('layouts.app')

@section('meta-desc')
    <meta name="description" content="Lorem ipsum dolor sit amet consectetur adipisicing elit. Autem nam veniam tempora fugit fuga pariatur atque maiores consequuntur asperiores dolores! Facere natus vitae odit, quis corporis recusandae ad consectetur numquam!"/>
@endsection

@section('meta-title')
{{ __('Your addresses') }}
@endsection

@section('breadcrumb')
    <x-breadcrumb-item route="{{ route('users.dashboard') }}" label="{{ __('Account') }}" />
    <x-breadcrumb-item route="{{ route('users.addresses.index') }}" label="{{ __('Addresses') }}" active />
@endsection

@section('content')

<section class="my-12 min-h-full px-6 py-10 relative">
    <article class="mb-6 flex items-end">
        <h2 class="text-xl font-semibold text-gray-600">{{ __('Your addresses') }}</h2>
    </article>
    Lorem ipsum dolor sit amet consectetur adipisicing elit. Asperiores, error alias sapiente accusantium similique eaque, aliquid debitis cum at qui ullam exercitationem neque dignissimos libero culpa blanditiis. Repellat alias libero nesciunt, dignissimos sapiente at ut quisquam consectetur sint excepturi laboriosam recusandae, error accusantium nobis, pariatur laborum saepe beatae molestias ea doloribus itaque? Distinctio necessitatibus quod iusto, non accusantium incidunt vel reprehenderit quos, fugit porro corporis expedita. Ea dolorum fugiat unde quam molestiae consectetur doloremque non aspernatur a placeat ut accusantium voluptate laboriosam fuga at obcaecati ducimus sequi necessitatibus exercitationem quis adipisci, dolores sit saepe natus. Itaque exercitationem quod in, soluta dolorem tempore suscipit repudiandae placeat? Accusantium obcaecati rerum vel nobis quae dignissimos animi facilis delectus in eum ad qui, ratione consequatur tenetur necessitatibus nam fugit eligendi explicabo aperiam vitae! Possimus dolore aut eaque facilis earum! Nobis assumenda, maxime quis ullam vel dolores. Voluptatum laboriosam distinctio officiis rem consequuntur dolore delectus incidunt provident nihil, quidem odio excepturi praesentium nulla, alias beatae aut accusantium asperiores sunt. Enim vero, animi ipsam ex sit incidunt impedit asperiores doloribus suscipit a voluptatum quisquam praesentium cumque eum necessitatibus aliquam! Ex aspernatur unde numquam suscipit excepturi delectus, soluta beatae dolor explicabo error similique, modi harum reiciendis, perferendis earum dicta minima sequi voluptas doloremque consequuntur? Illo optio adipisci, impedit dolore, hic a minima sapiente ut aliquam perspiciatis dolorem sit? Numquam sunt sed in deleniti natus ducimus praesentium nobis hic, quam quae quas culpa quasi doloribus excepturi vero tenetur tempore iusto fuga accusantium quisquam ut maxime atque minus autem. Error, optio animi eveniet illo incidunt, molestias quis magnam molestiae magni distinctio harum. Cupiditate iure, quidem reprehenderit voluptatum repellat eos doloremque maxime sed reiciendis aspernatur, totam ipsa corrupti blanditiis ullam nesciunt officiis architecto iste, possimus magnam a? Suscipit esse sapiente quod necessitatibus perspiciatis labore illum? Sit quod labore totam eaque omnis deleniti, nemo eum accusantium veniam mollitia recusandae, aliquid quidem, at vitae sequi! Asperiores labore at, architecto maiores aspernatur quasi nam! Neque, voluptatum earum labore mollitia tempora inventore quia ad ratione cupiditate exercitationem animi numquam, hic sequi beatae architecto? Explicabo ut quo modi sequi mollitia voluptatem fuga rerum ipsum cum. Nihil voluptatibus deleniti, reiciendis, ad necessitatibus id tempore, a modi vero ab excepturi nostrum numquam facere obcaecati harum aut eos maiores perspiciatis. Ipsam, dignissimos ipsa laboriosam amet facere ad laborum labore, voluptates quas deleniti voluptatum dicta similique quos animi exercitationem consectetur. Ab cumque voluptatem blanditiis quos sapiente fugiat labore debitis veniam, excepturi explicabo fuga aliquam consectetur magnam dolor vero qui, nam nesciunt nulla adipisci voluptatum aspernatur nobis vel perferendis eaque! Amet quasi impedit explicabo nemo nobis ex exercitationem odio, porro atque, at quis quibusdam animi expedita cupiditate aperiam! Nemo esse consequatur odit. Sequi ad aut corporis laborum velit ipsa assumenda voluptate illum veritatis quos natus saepe neque, dolorem aperiam vel minima cumque error excepturi. Suscipit officiis debitis odit, dolore accusamus minima iste voluptas veniam mollitia labore. Similique maxime aperiam eius, est quia quaerat voluptas odit magnam fugiat libero exercitationem autem amet. Aliquid, qui assumenda. Et nisi autem perspiciatis quaerat deserunt?
</section>


@endsection
