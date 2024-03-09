<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'social_name' => $this->faker->name(),
            'birth_date' => $this->faker->date(),
            'cpf' => $this->faker->numerify('###########'),
            'photo' => $this->faker->imageUrl(),
        ];
    }
}
