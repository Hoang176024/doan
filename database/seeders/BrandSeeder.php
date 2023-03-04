<?php

namespace Database\Seeders;

use App\Models\Admin\Brand;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('brands')->truncate();
        Brand::factory()
            ->count(10)
            ->create();
    }
}
