<?php

namespace App\Constant;

class Keterangan
{
    const SUDAH_UJIAN = 1;
    const BELUM_UJIAN = 2;

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
            self::SUDAH_UJIAN => "Sudah Seminar",
            self::BELUM_UJIAN => "Belum Seminar",
        ];
    }

    public static function htmlLabels(): array
    {
        return [
            self::SUDAH_UJIAN => 'success',
            self::BELUM_UJIAN => 'danger',

        ];
    }

    public static function toHTML($id)
    {
        $label = self::htmlLabels()[$id];
        $text = self::label($id);
        return '<span class="badge badge-' . $label . '">' . $text . '</span>';
    }
}
