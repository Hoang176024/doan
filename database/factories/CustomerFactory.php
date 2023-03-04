<?php

namespace Database\Factories;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Customer::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'phone' => $this->faker->numerify('0##########'),
            'email' => $this->faker->unique()->safeEmail(),
            'note' => $this->faker->text(200),
            'address' => $this->faker->address(),
            'customer_group_id'=>$this->faker->numberBetween(1,6),
        ];
    }
}
