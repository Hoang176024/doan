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

        // Create 10 unique suppliers with random information
        $suppliers = [            
            ['name' => 'ABC Company', 'address' => '123 Main St', 'phone' => '555-1234', 'email' => 'abc@example.com'],
            ['name' => 'XYZ Corp', 'address' => '456 Elm St', 'phone' => '555-5678', 'email' => 'xyz@example.com'],
            ['name' => 'Smith Industries', 'address' => '789 Oak St', 'phone' => '555-9012', 'email' => 'smith@example.com'],
            ['name' => 'Jones Enterprises', 'address' => '321 Maple Ave', 'phone' => '555-3456', 'email' => 'jones@example.com'],
            ['name' => 'Green & Sons', 'address' => '654 Birch Rd', 'phone' => '555-7890', 'email' => 'green@example.com'],
            ['name' => 'White Supplies', 'address' => '987 Cedar Ln', 'phone' => '555-2345', 'email' => 'white@example.com'],
            ['name' => 'Blue Co.', 'address' => '246 Pine St', 'phone' => '555-6789', 'email' => 'blue@example.com'],
            ['name' => 'Purple Trading', 'address' => '369 Oak St', 'phone' => '555-0123', 'email' => 'purple@example.com'],
            ['name' => 'Orange Supply', 'address' => '852 Elm St', 'phone' => '555-4567', 'email' => 'orange@example.com'],
            ['name' => 'Yellow Industries', 'address' => '753 Maple Ave', 'phone' => '555-8901', 'email' => 'yellow@example.com'],
        ];

        // Loop through the array of suppliers and create records
        foreach ($suppliers as $supplier) {
            Supplier::create($supplier);
        }
    }
}
