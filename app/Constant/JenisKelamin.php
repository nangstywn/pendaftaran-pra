<?php

namespace App\Constant;

class JenisKelamin
{
    const LAKI_LAKI = 1;
    const PEREMPUAN = 2;

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
            self::LAKI_LAKI => "Laki-laki",
            self::PEREMPUAN => "Perempuan",
        ];
    }
}