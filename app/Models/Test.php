<?php

namespace App\Models;

use App\Models\Concerns\HasTranslations;
use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    use HasTranslations;

    protected $fillable = ['lesson_id', 'title', 'questions', 'translations'];

    protected $casts = [
        'questions' => 'array',
        'translations' => 'array',
    ];

    public function lesson()
    {
        return $this->belongsTo(Lesson::class);
    }

    public function localizedQuestions(?string $locale = null): array
    {
        $locale = $locale ?? app()->getLocale();
        $translations = $this->translations ?? [];

        if (isset($translations[$locale]['questions']) && is_array($translations[$locale]['questions'])) {
            return $translations[$locale]['questions'];
        }

        if ($locale !== 'kk' && isset($translations['kk']['questions'])) {
            return $translations['kk']['questions'];
        }

        return $this->questions ?? [];
    }

    public function localizedTitle(?string $locale = null): ?string
    {
        $title = $this->translate('title', $locale);

        if ($title) {
            return $title;
        }

        return $this->title;
    }
}
