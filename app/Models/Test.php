<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = ['lesson_id', 'title', 'questions'];

    protected $casts = [
        'questions' => 'array',
    ];

    public function lesson() {
        return $this->belongsTo(Lesson::class);
    }
}
