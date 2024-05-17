<?php

namespace Database\Factories;
use App\Models\Staff;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Staff>
 */
class StaffFactory extends Factory
{
    protected $model = Staff::class;
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'staff' => $this->faker->name,  // Generates a fake name
            'email' => $this->faker->unique()->safeEmail,  // Generates a unique email
            'password' => $this->faker->password,  // Generates a password
            'branch' => $this->faker->city  // Uses city name as a fake location for branch


        ];
    }
}
