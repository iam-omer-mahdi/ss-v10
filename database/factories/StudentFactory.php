<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class StudentFactory extends Factory
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
                'nationality_id' => $this->faker->numberBetween(1, 10),
                'guardian_relation_id' => $this->faker->numberBetween(1, 10),
                'guardian_workplace' => $this->faker->sentence(4),
                'mother_f_phone' => $this->faker->numberBetween(1009017091,9909017091),
                'mother_s_phone' => $this->faker->numberBetween(1009017091,9909017091),
                'guardian' => $this->faker->name(),
                'guardian_f_phone' => $this->faker->numberBetween(1009017091,9909017091),
                'guardian_s_phone' => $this->faker->numberBetween(1009017091,9909017091),
                'classroom_id' => $this->faker->numberBetween(1,2), 
        ];
    }
}
