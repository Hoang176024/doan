<?php

namespace Database\Seeders;

use App\Models\Admin\Tax;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TaxSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('taxes')->truncate();
        Tax::create([
           'name' => 'VAT - 10%',
            'rate' => '10'
        ]);

        Tax::create([
            'name' => 'Giá đã bao gồm thuế',
            'rate' => '0'
        ]);
    }
}
