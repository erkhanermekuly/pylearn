<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    protected $fillable = [
    'group_id',
    'title',
    'content',
    'pdf_path',
];

public function group()
{
    return $this->belongsTo(Group::class);
}

public function assignments()
{
    return $this->hasMany(Assignment::class);
}
public function test() {
    return $this->hasOne(Test::class);
}
}
