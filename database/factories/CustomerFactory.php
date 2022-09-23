<?php

namespace Database\Factories;

// use App\Models\Customer;
use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $faker = \Faker\Factory::create('ja_JP');
        $post_code_address = explode(' ', $faker->address(), 3);
        return [
            'name' => $faker->name(),
            'email' => $this->faker->unique()->safeEmail(),
            'post_code' => $post_code_address[0],
            'address' => $post_code_address[2],
            'tel' => $faker->phoneNumber(),
        ];
    }
}
