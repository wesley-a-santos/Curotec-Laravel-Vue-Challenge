<?php

namespace Database\Factories;

use App\Models\Gender;
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
        $genders = Gender::all()->pluck('id')->toArray();
        $users = Gender::all()->pluck('id')->toArray();

        return [
            'gender_id' => $genders[array_rand($genders)],
            'first_name' => $this->faker->firstName(),
            'surname' => $this->faker->lastName(),
            'social_security_number' => $this->faker->numerify('##########'),
            'birth_date' => $this->faker->date('Y-m-d'),
            'first_contact_date' => $this->faker->date('Y-m-d'),
            'user_id' => $users[array_rand($users)],
        ];
    }
}
