<?php

namespace Database\Seeders;

use App\Models\Delivery;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::table('deliveries')->truncate();
        Delivery::create([
            'province_id' => 1,
            'district_id' => 27,
            'ward_id' => 473,
            'fee' => 10000,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Delivery::create([
            'province_id' => 1,
            'district_id' => 27,
            'ward_id' => 474,
            'fee' => 11000,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Delivery::create([
            'province_id' => 1,
            'district_id' => 27,
            'ward_id' => 475,
            'fee' => 12000,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Delivery::create([
            'province_id' => 1,
            'district_id' => 27,
            'ward_id' => 476,
            'fee' => 13000,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

        Delivery::create([
            'province_id' => 1,
            'district_id' => 27,
            'ward_id' => 477,
            'fee' => 14000,
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);

    }
}
