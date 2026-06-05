<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    protected $fillable = [
    'name',
];


public function users()
{
    return $this->belongsToMany(User::class, 'group_user');
}

public function lessons()
{
    return $this->hasMany(Lesson::class);
}

public function assignments()
{
    return $this->hasMany(Assignment::class);
}

}
