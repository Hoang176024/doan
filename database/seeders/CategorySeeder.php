<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();
        $parent1 = Category::create([
            'name' => 'Food and Beverage',
            'parent_id' => 0,
            'description' => 'All kinds of food and beverage products',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        $parent2 = Category::create([
            'name' => 'Household Items',
            'parent_id' => 0,
            'description' => 'Various household items and products',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        // Create child categories
        Category::create([
            'name' => 'Snacks',
            'parent_id' => $parent1->id,
            'description' => 'All kinds of snacks',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        Category::create([
            'name' => 'Beverages',
            'parent_id' => $parent1->id,
            'description' => 'All kinds of beverages',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        Category::create([
            'name' => 'Cleaning Supplies',
            'parent_id' => $parent2->id,
            'description' => 'Cleaning products and supplies',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        Category::create([
            'name' => 'Kitchenware',
            'parent_id' => $parent2->id,
            'description' => 'Various kitchenware items and products',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        Category::create([
            'name' => 'Personal Care',
            'parent_id' => $parent2->id,
            'description' => 'Personal care and grooming products',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        Category::create([
            'name' => 'Frozen Foods',
            'parent_id' => $parent1->id,
            'description' => 'All kinds of frozen foods',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        Category::create([
            'name' => 'Pet Supplies',
            'parent_id' => $parent2->id,
            'description' => 'Products for pets and pet owners',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        Category::create([
            'name' => 'Stationery',
            'parent_id' => $parent2->id,
            'description' => 'Various stationery items and products',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
        
        Category::create([
            'name' => 'Toys and Games',
            'parent_id' => $parent2->id,
            'description' => 'Toys and games for all ages',
            'created_at' => new \dateTime,
            'updated_at' => new \dateTime,
        ]);
    }
}
