<?php

namespace App\Constant;

class BimbinganStatus
{
    const PROSES = 1;
    const DITOLAK = 2;
    const DITERIMA = 3;

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
            self::PROSES => "Menunggu Persetujuan",
            self::DITOLAK => "Ditolak",
            self::DITERIMA => "Diterima",
        ];
    }

    public static function htmlLabels(): array
    {
        return [
            self::PROSES => 'danger',
            self::DITOLAK => 'dark',
            self::DITERIMA => 'success',

        ];
    }
    public static function toHTML($id)
    {
        $label = self::htmlLabels()[$id];
        $text = self::label($id);
        return '<span class="badge badge-' . $label . '">' . $text . '</span>';
    }
}