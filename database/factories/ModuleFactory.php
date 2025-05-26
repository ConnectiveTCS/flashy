<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Module>
 */
class ModuleFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $modules = [
            'FIT152 - Fundamentals of Information Technology',
            'ACC152 - Accounting 1',
            'IBS152 - Introduction to Business Studies',
            'SEN152 - Software Engineering',
            'CTIP152 - Computational Thinking and Information Processing',
        ];

        return [
            //
            // for each name in sequence, create a module with a random name from the list  
            'name' => $this->faker->unique()->randomElement($modules),
            'user_id' => 1, // Assuming a default user ID for factory purposes
            'description' => $this->faker->sentence(),
        ];
    }
}
