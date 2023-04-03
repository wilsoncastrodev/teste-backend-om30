<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Http\UploadedFile;
use App\Helpers\Helper;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Patient>
 */
class PatientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => fake()->firstName() . " " . fake()->lastName() . " " . fake()->lastName(),
            'mother_name' => fake()->firstNameFemale() . " " . fake()->lastName() . " " . fake()->lastName(),
            'birth_date' => fake()->date('d/m/Y'),
            'cpf' => fake()->cpf(),
            'cns' => Helper::generateCNS(),
            'photo' => UploadedFile::fake()->create('foto.jpeg')
        ];
    }
}
