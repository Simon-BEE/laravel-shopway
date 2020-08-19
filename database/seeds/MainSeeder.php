<?php

use App\Models\Page;
use App\Models\Shop;
use App\Models\Products\Product;
use App\Models\Products\Category;
use Illuminate\Database\Seeder;
use App\Models\Products\ProductOption;

class MainSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Category::class, 5)->create()->each(function ($category){
            $category->products()->saveMany(factory(Product::class, mt_rand(2, 9))->create());
            $category->products->each(function ($product){

                $product->product_options()->saveMany(factory(ProductOption::class, mt_rand(1, 2))->make());
                $product->product_options->each(function ($productOption){

                    $productOption->sizes()->attach([
                        1 => ['quantity' => 10],
                        2 => ['quantity' => 10],
                        3 => ['quantity' => 10],
                        4 => ['quantity' => 10],
                        5 => ['quantity' => 10],
                    ]);

                    $productOption->images()->create([
                        'filename' => 'product_' . mt_rand(1, 2) . '.jpg',
                    ]);
                });

            });
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
