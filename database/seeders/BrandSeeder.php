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

        $brands = [    ['name' => 'Nestlé'],
            ['name' => 'Mars'],
            ['name' => 'Hershey\'s'],
            ['name' => 'Ferrero'],
            ['name' => 'Mondelez'],
        ];

        foreach ($brands as $brand) {
            Brand::create($brand);
        }
    }
}
