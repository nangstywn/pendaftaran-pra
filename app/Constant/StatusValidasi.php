<?php

namespace App\Constant;

class StatusValidasi
{
    const BELUM_VALIDASI = 1;
    const VALIDASI = 2;

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
            self::VALIDASI => "Disetujui",
            self::BELUM_VALIDASI => "Belum Validasi",
        ];
    }

    public static function htmlLabels(): array
    {
        return [
            self::VALIDASI => 'success',
            self::BELUM_VALIDASI => 'danger',

        ];
    }

    public static function toHTML($id)
    {
        $label = self::htmlLabels()[$id];
        $text = self::label($id);
        return '<span class="badge badge-' . $label . '">' . $text . '</span>';
    }
}
