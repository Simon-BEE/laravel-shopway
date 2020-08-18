<?php

use App\Models\Products\Size;
use App\Models\Products\Color;
use App\Models\Products\Material;
use Illuminate\Database\Seeder;

class OptionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Size::insert([
            ['name' => 'XS'],
            ['name' => 'S'],
            ['name' => 'M'],
            ['name' => 'L'],
            ['name' => 'XL'],
            ['name' => 'XXL'],
        ]);

        Color::insert([
            ['name' => 'red'],
            ['name' => 'black'],
            ['name' => 'green'],
            ['name' => 'white'],
            ['name' => 'blue'],
            ['name' => 'orange'],
            ['name' => 'purple'],
            ['name' => 'gray'],
            ['name' => 'yellow'],
            ['name' => 'pink'],
        ]);

        Material::insert([
            ['name' => 'cotton'],
            ['name' => 'polyester'],
            ['name' => 'wool'],
            ['name' => 'silk'],
            ['name' => 'flax'],
            ['name' => 'nylon'],
        ]);
    }
}
