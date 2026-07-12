<?php

if (!function_exists('localized')) {
    /**
     * Get localized field from a model based on current locale.
     * Returns Hindi value if locale is 'hi' and available, otherwise English value.
     */
    function localized($model, string $field): ?string
    {
        if (method_exists($model, 'localized')) {
            return $model->localized($field);
        }

        $locale = app()->getLocale();
        if ($locale === 'hi') {
            $hiField = $field . '_hi';
            if (isset($model->{$hiField}) && !empty($model->{$hiField})) {
                return $model->{$hiField};
            }
        }
        return $model->{$field};
    }
}

if (!function_exists('is_hi_locale')) {
    function is_hi_locale(): bool
    {
        return app()->getLocale() === 'hi';
    }
}

if (!function_exists('current_lang')) {
    function current_lang(): string
    {
        return app()->getLocale();
    }
}
