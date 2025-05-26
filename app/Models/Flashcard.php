<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Flashcard extends Model
{
    use \Illuminate\Database\Eloquent\Factories\HasFactory;
    //
    protected $fillable = [
        'user_id',
        'question',
        'answer',
        'module_id',
        'topic_id',
        'image',
        'is_bookmarked',
        'is_correct',
        'is_incorrect',
    ];
    protected $casts = [
        'is_bookmarked' => 'boolean',
        'is_correct' => 'boolean',
        'is_incorrect' => 'boolean',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function module()
    {
        return $this->belongsTo(Module::class);
    }
    public function topic()
    {
        return $this->belongsTo(Topic::class);
    }
}
