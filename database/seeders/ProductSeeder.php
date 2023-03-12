<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->truncate();
        Product::create([
            'name' => 'Milky Way Bar',
            'price_in' => 17250,
            'price_out' =>34500,
            'quantity' => 100,
            'barcode' => '1234567890123',
            'category_id' => 2,
            'brand_id' => 1,
            'unit_id' => 1,
            'supplier_id' => 1,
        ]);
        
        Product::create([
            'name' => 'Ritz Crackers',
            'price_in' => 28750 ,
            'price_out' => 57500,
            'quantity' => 50,
            'barcode' => '1234567890124',
            'category_id' => 2,
            'brand_id' => 2,
            'unit_id' => 2,
            'supplier_id' => 2,
        ]);
        
        Product::create([
            'name' => 'Lipton Tea Bags',
            'price_in' => 57500 ,
            'price_out' => 103500,
            'quantity' => 75,
            'barcode' => '1234567890125',
            'category_id' => 2,
            'brand_id' => 3,
            'unit_id' => 3,
            'supplier_id' => 3,
        ]);
        
        Product::create([
            'name' => 'Coca Cola Can',
            'price_in' => 11500 ,
            'price_out' =>23000,
            'quantity' => 200,
            'barcode' => '1234567890126',
            'category_id' => 1,
            'brand_id' => 4,
            'unit_id' => 4,
            'supplier_id' => 4,
        ]);
        
        Product::create([
            'name' => 'Bounty Bar',
            'price_in' =>19550 ,
            'price_out' => 40250,
            'quantity' => 100,
            'barcode' => '1234567890127',
            'category_id' => 5,
            'brand_id' => 1,
            'unit_id' => 1,
            'supplier_id' => 1,
        ]);
        
        Product::create([
            'name' => 'Trident Gum',
            'price_in' => 4600,
            'price_out' => 11500,
            'quantity' => 150,
            'barcode' => '1234567890128',
            'category_id' => 5,
            'brand_id' => 5,
            'unit_id' => 5,
            'supplier_id' => 5,
        ]);
        
        Product::create([
            'name' => 'Doritos Chips',
            'price_in' => 34500 ,
            'price_out' =>69000,
            'quantity' => 50,
            'barcode' => '1234567890129',
            'category_id' => 2,
            'brand_id' => 2,
            'unit_id' => 2,
            'supplier_id' => 2,
        ]);
        
        Product::create([
            'name' => 'Red Bull Can',
            'price_in' => 28750,
            'price_out' => 57500,
            'quantity' => 75,
            'barcode' => '1234567890130',
            'category_id' => 4,
            'brand_id' => 4,
            'unit_id' => 4,
            'supplier_id' =>2,
        ]);
        Product::create([
            'name' => 'Coca Cola 1.5L',
            'price_in' => 18400 ,
            'price_out' => 34500,
            'quantity' => 100,
            'barcode' => '1234567890112',
            'category_id' => 1,
            'brand_id' => 2,
            'unit_id' => 1,
            'supplier_id' => 6,
        ]);
        
        Product::create([
            'name' => 'Mentos Strawberry',
            'price_in' => 2300 ,
            'price_out' => 6900,
            'quantity' => 500,
            'barcode' => '1234567890129',
            'category_id' => 2,
            'brand_id' => 3,
            'unit_id' => 4,
            'supplier_id' => 4,
        ]);
        
        Product::create([
            'name' => 'Oreo Chocolate Cookies',
            'price_in' => 11500,
            'price_out' => 27600,
            'quantity' => 200,
            'barcode' => '1234567890136',
            'category_id' => 3,
            'brand_id' => 4,
            'unit_id' => 5,
            'supplier_id' => 8,
        ]);
        
        Product::create([
            'name' => 'Nestle Milo Chocolate Powder',
            'price_in' => 34500 ,
            'price_out' => 69000,
            'quantity' => 50,
            'barcode' => '1234567890143',
            'category_id' => 4,
            'brand_id' => 5,
            'unit_id' => 3,
            'supplier_id' => 5,
        ]);
        
        Product::create([
            'name' => 'Heineken Beer 500ml',
            'price_in' => 27600 ,
            'price_out' => 57500,
            'quantity' => 100,
            'barcode' => '1234567890150',
            'category_id' => 5,
            'brand_id' => 2,
            'unit_id' => 2,
            'supplier_id' => 7,
        ]);
        
        Product::create([
            'name' => 'Coca-Cola 1.5L',
            'price_in' => 23000 ,
            'price_out' => 46000,
            'quantity' => 50,
            'barcode' => '2345678901234',
            'category_id' => 1,
            'brand_id' => 1,
            'unit_id' => 1,
            'supplier_id' => 1,
        ]);
        
        Product::create([
            'name' => 'M&M\'s 100g',
            'price_in' => 27600,
            'price_out' => 57500,
            'quantity' => 100,
            'barcode' => '3456789012345',
            'category_id' => 2,
            'brand_id' => 2,
            'unit_id' => 2,
            'supplier_id' => 2,
        ]);
        
        Product::create([
            'name' => 'Red Bull 250ml',
            'price_in' => 23000 ,
            'price_out' => 46000,
            'quantity' => 30,
            'barcode' => '4567890123456',
            'category_id' => 3,
            'brand_id' => 3,
            'unit_id' => 1,
            'supplier_id' => 3,
        ]);
        
        Product::create([
            'name' => 'Doritos 150g',
            'price_in' => 34500 ,
            'price_out' => 69000,
            'quantity' => 70,
            'barcode' => '5678901234567',
            'category_id' => 4,
            'brand_id' => 4,
            'unit_id' => 2,
            'supplier_id' => 4,
        ]);
        
        Product::create([
            'name' => 'Kit Kat 40g',
            'price_in' => 80500 ,
            'price_out' => 149500,
            'quantity' => 150,
            'barcode' => '6789012345678',
            'category_id' => 5,
            'brand_id' => 5,
            'unit_id' => 2,
            'supplier_id' => 5,
        ]);

        Product::create([
            'name' => 'Palmolive Naturals Shampoo 400ml',
            'price_in' => 13800,
            'price_out' => 27600,
            'quantity' => 30,
            'barcode' => '2345678901234',
            'category_id' => 1,
            'brand_id' => 4,
            'unit_id' => 5,
            'supplier_id' => 1,
            ]);
        
        Product::create([
            'name' => 'Colgate Total Toothpaste 150g',
            'price_in' => 27600 ,
            'price_out' => 57500,
            'quantity' => 40,
            'barcode' => '5678901234567',
            'category_id' => 5,
            'brand_id' => 5,
            'unit_id' => 2,
            'supplier_id' => 2,
            ]);

            Product::create([
                'name' => 'Pencil',
                'price_in' => 11500 ,
                'price_out' => 23000,
                'quantity' => 500,
                'barcode' => '6789012345678',
                'category_id' => 5,
                'brand_id' => 3,
                'unit_id' => 5,
                'supplier_id' => 1,
                ]);
                
                Product::create([
                'name' => 'A4 Paper',
                'price_in' => 28750 ,
                'price_out' => 57500,
                'quantity' => 500,
                'barcode' => '7890123456789',
                'category_id' => 5,
                'brand_id' => 4,
                'unit_id' => 8,
                'supplier_id' => 3,
                ]);
                
                Product::create([
                'name' => 'Stapler',
                'price_in' => 17250 ,
                'price_out' => 34500,
                'quantity' => 50,
                'barcode' => '8901234567890',
                'category_id' => 5,
                'brand_id' => 5,
                'unit_id' => 5,
                'supplier_id' => 2,
                ]);
                
                Product::create([
                'name' => 'Scissors',
                'price_in' => 17250 ,
                'price_out' => 34500,
                'quantity' => 100,
                'barcode' => '9012345678901',
                'category_id' => 5,
                'brand_id' => 6,
                'unit_id' => 5,
                'supplier_id' => 1,
                ]);
                
                Product::create([
                'name' => 'Calculator',
                'price_in' => 11500 ,
                'price_out' => 23000,
                'quantity' => 20,
                'barcode' => '0123456789012',
                'category_id' => 5,
                'brand_id' => 7,
                'unit_id' => 5,
                'supplier_id' => 3,
                ]);
        
    }
}
