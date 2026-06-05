<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    protected $fillable = [
        'assignment_id',
        'user_id',
        'code',
        'archive_path',
        'feedback',
        'grade',
];

public function assignment()
{
    return $this->belongsTo(Assignment::class);
}
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); 
    }

public function comments()
{
    return $this->hasMany(Comment::class);
}

}
