<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tax>
 */
class TaxFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {

        return [
            'name' => $this->faker->word(),
            'type' => $this->faker->randomElement(['VAT', 'IGST', 'CGST', 'SGST']),
            'rate' => $this->faker->randomFloat(3, 0)
        ];
    }
}
