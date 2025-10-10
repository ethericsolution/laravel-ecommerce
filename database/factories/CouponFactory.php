<?php

namespace Database\Factories;

use App\Models\Coupon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Coupon>
 */
class CouponFactory extends Factory
{


    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $types = ['flat', 'percent'];

        return [
            'code' => $this->faker->regexify('[A-Za-z0-9]{10}'),

            'description'   => $this->faker->realText(60),
            'type'          => $this->faker->randomElement($types),
            'value'         => $this->faker->numberBetween(1, 100),

            'max_discount_value' => $this->faker->numberBetween(1, 100),

            'start_date'    => now(),
            'end_date'      => now()->addDays(10),

            'total_quantity'    => $this->faker->numberBetween(1, 200),
            'use_per_user'      => $this->faker->numberBetween(1, 10),
            'min_cart_value'    => $this->faker->numberBetween(100, 500),
            'max_cart_value'    => $this->faker->numberBetween(500, 2000),
            'is_for_new_user'   => $this->faker->boolean(),
        ];
    }
}
