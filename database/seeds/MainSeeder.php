<?php

use App\Models\Page;
use App\Models\Shop;
use App\Models\Product;
use App\Models\Category;
use App\Models\Option;
use Illuminate\Database\Seeder;
use App\Models\ProductItemOption;

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

                $product->product_options()->saveMany(factory(ProductItemOption::class, mt_rand(1, 2))->make());
                $product->product_options->each(function ($productOption){

                    // All sizes (XS, S, etc..)
                    Option::where('option_type_id', 1)->get()->each(function ($option) use ($productOption){
                        $option->product_items()->attach($productOption);
                    });

                    // Random color
                    $this->randomColor($productOption);
                    // Random material
                    $productOption->options()->attach(18);

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

    public function randomColor($productOption)
    {
        $color = mt_rand(7, 16);

        $productOption->product->product_options->each(function ($item) use ($color, $productOption){
            if ($item->hasColor($color)) {
                $this->randomColor($productOption);
                return;
            }
        });

        $productOption->options()->attach($color);
        return;
    }
}
