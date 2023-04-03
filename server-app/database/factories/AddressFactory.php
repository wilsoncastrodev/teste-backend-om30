<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Address>
 */
class AddressFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'zipcode' => fake()->postcode(),
            'address' => fake()->streetName(),
            'number' => fake()->buildingNumber(),
            'complement' => fake()->secondaryAddress(),
            'neighborhood' => fake()->lastName() . " " . fake()->lastName(),
            'city' => fake()->city(),
            'state' => fake()->stateAbbr(),
        ];
    }
}
