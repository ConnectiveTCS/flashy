<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('flashcards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')
                  ->constrained('users')
                  ->onDelete('cascade')
                  ->comment('The ID of the user who created the flashcard');
            $table->string('question')->comment('The question or prompt of the flashcard');
            $table->text('answer')->comment('The answer to the flashcard question');
            $table->foreignId('module_id')
                  ->constrained('modules')
                  ->onDelete('cascade')
                  ->comment('The ID of the module this flashcard belongs to');
            $table->foreignId('topic_id')
                  ->constrained('topics')
                  ->onDelete('cascade')
                  ->comment('The ID of the topic this flashcard belongs to');
            $table->string('image')->nullable()->comment('Optional image associated with the flashcard');
            $table->boolean('is_bookmarked')->default(false)->comment('Indicates if the flashcard is bookmarked');
            $table->boolean('is_correct')->default(false)->comment('Indicates if the flashcard is marked as correct');
            $table->boolean('is_incorrect')->default(false)->comment('Indicates if the flashcard is marked as incorrect');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('flashcards');
    }
};
