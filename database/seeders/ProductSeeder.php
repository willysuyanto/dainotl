<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::create([
            'product_name' => 'Pertamax Turbo',
            'purchase_price' => '11371',
            'selling_price' => '12000',
            'quantity_per_trip' => '8000',
            'color' => '#f17c82',
        ]);

        Product::create([
            'product_name' => 'Pertamina Dex',
            'purchase_price' => '10200',
            'selling_price' => '10500',
            'quantity_per_trip' => '2000',
            'color' => '#77ff66',
        ]);

        Product::create([
            'product_name' => 'Pertamax',
            'purchase_price' => '8455',
            'selling_price' => '9000',
            'quantity_per_trip' => '8000',
            'color' => '#669eff',
        ]);

        Product::create([
            'product_name' => 'Pertalite',
            'purchase_price' => '7300',
            'selling_price' => '7600',
            'quantity_per_trip' => '8000',
            'color' => '#ffffee',
        ]);

        Product::create([
            'product_name' => 'Bio Solar',
            'purchase_price' => '4900',
            'selling_price' => '5150',
            'quantity_per_trip' => '8000',
            'color' => '#d6d6d6',
        ]);

        Product::create([
            'product_name' => 'Pertalite Khusus',
            'purchase_price' => '7800',
            'selling_price' => '8000',
            'quantity_per_trip' => '8000',
            'color' => '#fff8ac',
        ]);
    }
}
