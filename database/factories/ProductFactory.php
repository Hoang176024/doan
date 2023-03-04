<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name'=>$this->faker->name,
            'price_in' =>$this->faker->numberBetween(10000,50000),
            'price_out' =>$this->faker->numberBetween(60000,999999),
            'quantity'=>$this->faker->numberBetween(1,200),
            'quantity_alert'=>$this->faker->numberBetween(5,10),
            'barcode' =>$this->faker->numberBetween(1000000000000,9999999999999),
            'sale' =>$this->faker->numberBetween(0,90),
            'category_id'=>$this->faker->numberBetween(1,10),
            'brand_id'=>$this->faker->numberBetween(1,10),
            'unit_id'=>$this->faker->numberBetween(1,10),
            'supplier_id'=>$this->faker->numberBetween(1,10),
        ];
    }
}
