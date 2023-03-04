<?php

namespace Database\Seeders;

use App\Models\Product;
use App\Models\Supplier;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        DB::table('suppliers')->truncate();
        Supplier::create([
            'name' => 'Tân Hòa Phát',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'tanhoaphat@gmail.com',
        ]);

        Supplier::create([
            'name' => 'Suntory',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'suntory@gmail.com',
        ]);
        Supplier::create([
            'name' => 'VinaAcecook',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'VinaAcecook@gmail.com',
        ]);
        Supplier::create([
            'name' => 'Cocacola',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'cocacola@gmail.com',
        ]);
        Supplier::create([
            'name' => 'Pepsi',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'pepsi@gmail.com',
        ]);
        Supplier::create([
            'name' => 'Chinsu',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'chinsu@gmail.com',
        ]);
        Supplier::create([
            'name' => 'Apple',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'apple@gmail.com',
        ]);
        Supplier::create([
            'name' => 'Samsung',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'samsung@gmail.com',
        ]);
        Supplier::create([
            'name' => 'Vinamilk',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'vinamilk@gmail.com',
        ]);
        Supplier::create([
            'name' => 'Kinh Đô',
            'address' => 'Thành phố Hồ Chí Minh',
            'phone' => '0388489321',
            'email' => 'kinhdo@gmail.com',
        ]);
    }
}
