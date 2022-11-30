<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->name(),
            'address' => $this->faker->sentence(4),
            'mother_name' => $this->faker->name(),
            'nationality' => numberBetween(1, 23),
            'guardian_relation' => numberBetween(1, 23),
            'guardian_workplace' => $this->faker->sentence(4),
            'mother_f_phone' => randomNumber(10),
            'mother_s_phone' => randomNumber(10),
            'guardian' => $this->faker->name(),
            'guardian_f_phone' => randomNumber(10),
            'guardian_s_phone' => randomNumber(10),
            'classroom_id' => numberBetween(4, 6),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }
}
