<?php

use App\Models\Range;
use App\Models\State;
use App\Models\Country;
use App\Models\Shipping;
use App\Models\ShippingCompany;
use Illuminate\Database\Seeder;

class ShipStateSeeder extends Seeder
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
                'name' => 'Erreur de paiement',
                'slug' => 'error',
                'color' => 'indigo',
            ],
            [
                'name' => 'Annulé',
                'slug' => 'cancelled',
                'color' => 'red',
            ],
            [
                'name' => 'Paiement accepté',
                'slug' => 'paid',
                'color' => 'green',
            ],
            [
                'name' => 'Expédié',
                'slug' => 'send',
                'color' => 'blue',
            ],
            [
                'name' => 'Remboursé',
                'slug' => 'refund',
                'color' => 'pink',
            ],
        ]);
    }
}
