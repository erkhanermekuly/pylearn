<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
    'submission_id',
    'user_id',
    'comment',
];

public function submission()
{
    return $this->belongsTo(Submission::class);
}

public function user()
{
    return $this->belongsTo(User::class);
}

}
