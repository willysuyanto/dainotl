<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Nozzle;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $datas = [
            6655375.1,
            6219515.0,
            8350933.4,
            10330369.7,
            4886945.2,
            8083926.7,
            553522.8,
            122353.1,
            4593887.0,
            5549968.0,
            4826629.5,
            4816567.2,
            1826577.4,
            2018720.0,
            6534725.2,
            9239965.4,
            2471972.9,
            2949057.3,
            3802045.1,
            4574004.8,
            1062405.8,
            2356650.4,
            6065122.4,
            4240491.1,
            616098.2,
            601191.0,
            4489930.3,
            3583633.4,
        ];

        for ($i = 0; $i < count($datas); $i++) {
            info(($i + 1) . "-" . $datas[$i]);
            $nozzle = Nozzle::find($i + 1);
            $nozzle->sales()->create(
                [
                    'shift' => 1,
                    'first_totalizer' => $datas[$i],
                    'last_totalizer' => $datas[$i],
                    'sales_on_litre' => 0,
                    'sales_on_rupiah' => 0,
                ]
            );
        }
    }
}
