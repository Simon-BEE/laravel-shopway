<?php

use App\Models\Page;
use App\Models\Shop;
use App\Models\User;
use App\Models\Range;
use App\Models\State;
use App\Models\Address;
use App\Models\Category;
use App\Models\Country;
use App\Models\Product;
use App\Models\Shipping;
use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Country::insert([
            ['name' => 'France', 'tax' => 0.2],
            ['name' => 'Belgique', 'tax' => 0.2],
            ['name' => 'Suisse', 'tax' => 0],
            ['name' => 'Canada', 'tax' => 0],
        ]);

        Range::insert([
            ['max' => 1000],
            ['max' => 2000],
            ['max' => 5000],
            ['max' => 10000],
            ['max' => 100000],
        ]);

        ShippingCompany::insert([
            'name' => 'Collisimo',
        ]);

        Shipping::insert([
            ['company_id' => 1, 'country_id' => 1, 'range_id' => 1, 'price' => 725],
            ['company_id' => 1, 'country_id' => 1, 'range_id' => 2, 'price' => 895],
            ['company_id' => 1, 'country_id' => 1, 'range_id' => 3, 'price' => 1375],
            ['company_id' => 1, 'country_id' => 1, 'range_id' => 4, 'price' => 1955],
            ['company_id' => 1, 'country_id' => 1, 'range_id' => 5, 'price' => 2855],
            ['company_id' => 1, 'country_id' => 2, 'range_id' => 1, 'price' => 1550],
            ['company_id' => 1, 'country_id' => 2, 'range_id' => 2, 'price' => 1755],
            ['company_id' => 1, 'country_id' => 2, 'range_id' => 3, 'price' => 2245],
            ['company_id' => 1, 'country_id' => 2, 'range_id' => 4, 'price' => 2955],
            ['company_id' => 1, 'country_id' => 2, 'range_id' => 5, 'price' => 3855],
            ['company_id' => 1, 'country_id' => 3, 'range_id' => 1, 'price' => 1550],
            ['company_id' => 1, 'country_id' => 3, 'range_id' => 2, 'price' => 1755],
            ['company_id' => 1, 'country_id' => 3, 'range_id' => 3, 'price' => 2245],
            ['company_id' => 1, 'country_id' => 3, 'range_id' => 4, 'price' => 2955],
            ['company_id' => 1, 'country_id' => 3, 'range_id' => 5, 'price' => 3855],
            ['company_id' => 1, 'country_id' => 4, 'range_id' => 1, 'price' => 2765],
            ['company_id' => 1, 'country_id' => 4, 'range_id' => 2, 'price' => 3800],
            ['company_id' => 1, 'country_id' => 4, 'range_id' => 3, 'price' => 5565],
            ['company_id' => 1, 'country_id' => 4, 'range_id' => 4, 'price' => 6955],
            ['company_id' => 1, 'country_id' => 4, 'range_id' => 5, 'price' => 9855],
        ]);

        State::insert([
            [
                'name' => 'Attente chèque',
                'slug' => 'check',
                'color' => 'blue',
                'indice' => 1
            ],
            [
                'name' => 'Attente mandat administratif',
                'slug' => 'money-order',
                'color' => 'blue',
                'indice' => 1
            ],
            [
                'name' => 'Attente virement',
                'slug' => 'bank-transfer',
                'color' => 'blue',
                'indice' => 1
            ],
            [
                'name' => 'Attente paiement par carte',
                'slug' => 'card',
                'color' => 'blue',
                'indice' => 1
            ],
            [
                'name' => 'Erreur de paiement',
                'slug' => 'error',
                'color' => 'red',
                'indice' => 0
            ],
            [
                'name' => 'Annulé',
                'slug' => 'cancelled',
                'color' => 'red',
                'indice' => 2
            ],
            [
                'name' => 'Mandat administratif reçu', 'slug' => 'money-order-ok', 'color' => 'green', 'indice' => 3],
            [
                'name' => 'Paiement accepté',
                'slug' => 'payment_ok',
                'color' => 'green',
                'indice' => 4
            ],
            [
                'name' => 'Expédié',
                'slug' => 'send',
                'color' => 'green',
                'indice' => 5
            ],
            [
                'name' => 'Remboursé',
                'slug' => 'refund',
                'color' => 'red',
                'indice' => 6
            ],
        ]);

        factory(User::class, 20)
            ->create()
            ->each(function ($user) {
                $user->addresses()->createMany(
                    factory(Address::class, mt_rand(2, 3))->make()->toArray()
                );
        });

        factory(Category::class, 20)->create()->each(function ($category){
            $category->products()->saveMany(factory(Product::class, mt_rand(6, 32))->create()->each(function ($product){
                $product->images()->create([
                    'filename' => 'product_' . mt_rand(1, 2) . '.jpg',
                ]);
            }));
        });

        factory(Shop::class)->create();

        $items = [
            ['livraisons', 'Livraisons'],
            ['mentions-legales', 'Mentions légales'],
            ['conditions-generales-de-vente', 'Conditons générales de vente'],
            ['politique-de-confidentialite', 'Politique de confidentialité'],
            ['respect-environnement', 'Respect de l\'environnement'],
            ['mandat-administratif', 'Mandat administratif'],
        ];
        foreach($items as $item) {
            factory(Page::class)->create([
                'slug' => $item[0],
                'title' => $item[1],
            ]);
        }
    }
}
