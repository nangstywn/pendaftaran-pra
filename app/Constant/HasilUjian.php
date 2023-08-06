<?php

namespace App\Constant;

class HasilUjian
{
    const LULUS = 1;
    const TIDAK_LULUS = 2;

    public static function label($id = false): string
    {
        if ($id === false) {
            return '';
        }

        return static::labels()[$id] ?? '';
    }

    public static function labels(): array
    {
        return [
            self::LULUS => "Lulus",
            self::TIDAK_LULUS => "Tidak Lulus",
        ];
    }

    public static function htmlLabels(): array
    {
        return [
            self::LULUS => 'success',
            self::TIDAK_LULUS => 'danger',

        ];
    }

    public static function toHTML($id)
    {
        $label = self::htmlLabels()[$id];
        $text = self::label($id);
        return '<span class="badge badge-' . $label . '">' . $text . '</span>';
    }
}
