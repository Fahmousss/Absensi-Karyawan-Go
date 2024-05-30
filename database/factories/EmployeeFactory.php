<?php

namespace Database\Factories;

use App\Department;
use App\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Employee>
 */
class EmployeeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'user_id' => User::factory(),
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'dob' => $this->faker->date(),
            'sex' => $this->faker->randomElement(['Laki-laki', 'Perempuan']),
            'desg' => $this->faker->randomElement(['Direktur', 'Produksi', 'Marketing','Design Grafis','Internship' ]),
            'department_id' => Department::factory(),
            'join_date' => $this->faker->date(),
            'salary' => $this->faker->numberBetween(100000, 200000),
        ];
    }
}
