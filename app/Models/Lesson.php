<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasTranslations;

    protected $fillable = [
        'group_id',
        'title',
        'content',
        'pdf_path',
        'translations',
    ];

    protected $casts = [
        'translations' => 'array',
    ];

    public function group()
    {
        return $this->belongsTo(Group::class);
    }

    public function assignments()
    {
        return $this->hasMany(Assignment::class);
    }

    public function test()
    {
        return $this->hasOne(Test::class);
    }
}
