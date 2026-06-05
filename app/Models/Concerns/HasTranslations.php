<?php

namespace App\Models\Concerns;

trait HasTranslations
{
    public function translate(string $field, ?string $locale = null): mixed
    {
        $locale = $locale ?? app()->getLocale();
        $translations = $this->translations ?? [];

        if (isset($translations[$locale][$field])) {
            return $translations[$locale][$field];
        }

        if ($locale !== 'kk' && isset($translations['kk'][$field])) {
            return $translations['kk'][$field];
        }

        return $this->attributes[$field] ?? null;
    }

    public function localizedTitle(?string $locale = null): ?string
    {
        return $this->translate('title', $locale);
    }
}
