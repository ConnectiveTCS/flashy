<?php

namespace Database\Seeders;

use \App\Models\Flashcard;
use \App\Models\Module;
use \App\Models\Topic;
use \App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class FlashcardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        //Modules and Topics list
        $modules = [
            'FIT152 - Fundamentals of Information Technology',
            'ACC152 - Accounting 1',
            'IBS152 - Introduction to Business Studies',
            'SEN152 - Software Engineering',
            'CTIP152 - Computational Thinking and Information Processing',
        ];
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

        // Create Modules
        foreach ($modules as $moduleName) {
            Module::factory()->create([
                'name' => $moduleName,
                'user_id' => 1,
            ]);
        }
        // Create Topics
        foreach ($topics as $topicName) {
            Topic::factory()->create([
                'name' => $topicName,
                'user_id' => 1,
            ]);
        }
        
        Flashcard::factory(50)->create()->each(function ($flashcard) {
            $flashcard->user()->associate(User::inRandomOrder()->first());
            $flashcard->module()->associate(Module::inRandomOrder()->first());
            $flashcard->topic()->associate(Topic::inRandomOrder()->first());
            $flashcard->save();
        });
    }
}
