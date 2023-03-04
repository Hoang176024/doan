<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Unit;

class UnitSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('units')->truncate();
        Unit::create([
            'unit_code' => 123,
            'unit_name' => 'Chai',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 103,
            'unit_name' => 'Lon',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 193,
            'unit_name' => 'Chiếc',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 789,
            'unit_name' => 'Túi',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 123,
            'unit_name' => 'Hộp',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 123,
            'unit_name' => 'Lọ',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 123,
            'unit_name' => 'KG',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 123,
            'unit_name' => 'Thùng',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 123,
            'unit_name' => 'Gói',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);

        Unit::create([
            'unit_code' => 123,
            'unit_name' => 'Lốc',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
