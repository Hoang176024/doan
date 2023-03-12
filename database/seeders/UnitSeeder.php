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
    'unit_code' => 'BT',
    'unit_name' => 'Bottle',
]);

Unit::create([
    'unit_code' => 'PK',
    'unit_name' => 'Pack',
]);

Unit::create([
    'unit_code' => 'kg',
    'unit_name' => 'Kilogram'
]);

Unit::create([
    'unit_code' => 'g',
    'unit_name' => 'Gram'
]);

Unit::create([
    'unit_code' => 'pcs',
    'unit_name' => 'Pieces'
]);

Unit::create([
    'unit_code' => 'ltr',
    'unit_name' => 'Liter'
]);

Unit::create([
    'unit_code' => 'ml',
    'unit_name' => 'Milliliter'
]);

Unit::create([
    'unit_code' => 'r',
    'unit_name' => 'Ream'
]);

Unit::create([
    'unit_code' => 't',
    'unit_name' => 'Tube'
]);

Unit::create([
    'unit_code' => 'roll',
    'unit_name' => 'Roll'
]);
    }
}
