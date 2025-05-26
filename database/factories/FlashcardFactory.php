<?php

namespace Database\Factories;

use \App\Models\Module;
use \App\Models\Topic;
use \App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Flashcard>
 */
class FlashcardFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            //
            'user_id' => 1,
            'question' => $this->faker->sentence(),
            'answer' => $this->faker->paragraph(),
            'module_id' => 1,
            'topic_id' => 1,
            'image' => $this->faker->imageUrl(640, 480, 'nature', true, 'Flashcard'),
            'is_bookmarked' => $this->faker->boolean(),
            'is_correct' => $this->faker->boolean(),
            'is_incorrect' => $this->faker->boolean(),
        ];
    }
}
