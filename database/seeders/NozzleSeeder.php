<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class NozzleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $turbo = Product::find(1);
        $dex = Product::find(2);
        $max = Product::find(3);
        $lite = Product::find(4);
        $bio = Product::find(5);
        $khu = Product::find(6);


        //Pulau 1
        $bio->nozzles()->create([
            'group' => 'P1'
        ]);
        $bio->nozzles()->create([
            'group' => 'P1'
        ]);

        $lite->nozzles()->create([
            'group' => 'P1'
        ]);
        $lite->nozzles()->create([
            'group' => 'P1'
        ]);
        
        //pulau 2
        $lite->nozzles()->create([
            'group' => 'P2'
        ]);
        $lite->nozzles()->create([
            'group' => 'P2'
        ]);

        $turbo->nozzles()->create([
            'group' => 'P2'
        ]);
        $turbo->nozzles()->create([
            'group' => 'P2'
        ]);

        $max->nozzles()->create([
            'group' => 'P2'
        ]);
        $max->nozzles()->create([
            'group' => 'P2'
        ]);

        //pulau3
        $bio->nozzles()->create([
            'group' => 'P3'
        ]);
        $bio->nozzles()->create([
            'group' => 'P3'
        ]);

        $lite->nozzles()->create([
            'group' => 'P3'
        ]);
        $lite->nozzles()->create([
            'group' => 'P3'
        ]);

        $khu->nozzles()->create([
            'group' => 'P3'
        ]);
        $khu->nozzles()->create([
            'group' => 'P3'
        ]);

         //Pulau 4
         $lite->nozzles()->create([
            'group' => 'P4'
        ]);
        $lite->nozzles()->create([
            'group' => 'P4'
        ]);

        $max->nozzles()->create([
            'group' => 'P4'
        ]);
        $max->nozzles()->create([
            'group' => 'P4'
        ]);

         //Pulau 5
         $lite->nozzles()->create([
            'group' => 'P5'
        ]);
        $lite->nozzles()->create([
            'group' => 'P5'
        ]);

        $khu->nozzles()->create([
            'group' => 'P5'
        ]);
        $khu->nozzles()->create([
            'group' => 'P5'
        ]);

         //Pulau 6
         $dex->nozzles()->create([
            'group' => 'P6'
        ]);
        $dex->nozzles()->create([
            'group' => 'P6'
        ]);

        $max->nozzles()->create([
            'group' => 'P6'
        ]);
        $max->nozzles()->create([
            'group' => 'P6'
        ]);


    }
}
