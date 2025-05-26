<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Topic>
 */
class TopicFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $topics = [
            'Topic 1',
            'Topic 2',
            'Topic 3',
            'Topic 4',
            'Topic 5',
            'Topic 6',
            'Topic 7',
            'Topic 8',
            'Topic 9',
            'Topic 10',
        ];

        return [
            //
            'name' => $this->faker->unique()->randomElement($topics), // Randomly select a topic name from the predefined list
            'user_id' => 1, // Assuming a default user ID for factory purposes
            'description' => $this->faker->sentence(),
        ];
    }
}
