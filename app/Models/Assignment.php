<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    protected $fillable = [
    'lesson_id',
    'title',
    'description',
];

public function lesson()
{
    return $this->belongsTo(Lesson::class);
}


public function group()
{
    return $this->belongsTo(Group::class);
}
public function submission()
{
    return $this->hasOne(Submission::class)->where('user_id', auth()->id());
}
  public function submissions()
    {
        return $this->hasMany(Submission::class);
    }
}
