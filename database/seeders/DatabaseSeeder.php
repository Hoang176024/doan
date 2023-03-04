<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(SupplierSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(UnitSeeder::class);
        $this->call(TaxSeeder::class);
        $this->call(ProductSeeder::class);
        $this->call(DeliverySeeder::class);
        $this->call(CustomerGroupSeeder::class);
        $this->call(CustomerSeeder::class);
    }
}
