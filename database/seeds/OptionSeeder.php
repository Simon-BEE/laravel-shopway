<?php

use App\Models\Option;
use App\Models\OptionType;
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
        OptionType::insert([
            ['name' => 'Size'],
            ['name' => 'Color'],
            ['name' => 'Material'],
        ]);

        Option::insert([
            ['option_type_id' => 1, 'name' => 'XS'],
            ['option_type_id' => 1, 'name' => 'S'],
            ['option_type_id' => 1, 'name' => 'M'],
            ['option_type_id' => 1, 'name' => 'L'],
            ['option_type_id' => 1, 'name' => 'XL'],
            ['option_type_id' => 1, 'name' => 'XXL'],
            ['option_type_id' => 2, 'name' => 'red'],
            ['option_type_id' => 2, 'name' => 'black'],
            ['option_type_id' => 2, 'name' => 'green'],
            ['option_type_id' => 2, 'name' => 'white'],
            ['option_type_id' => 2, 'name' => 'blue'],
            ['option_type_id' => 2, 'name' => 'orange'],
            ['option_type_id' => 2, 'name' => 'purple'],
            ['option_type_id' => 2, 'name' => 'gray'],
            ['option_type_id' => 2, 'name' => 'yellow'],
            ['option_type_id' => 2, 'name' => 'pink'],
            ['option_type_id' => 3, 'name' => 'cotton'],
            ['option_type_id' => 3, 'name' => 'polyester'],
            ['option_type_id' => 3, 'name' => 'wool'],
            ['option_type_id' => 3, 'name' => 'silk'],
            ['option_type_id' => 3, 'name' => 'flax'],
            ['option_type_id' => 3, 'name' => 'nylon'],
        ]);
    }
}
