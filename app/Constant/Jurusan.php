<?php

namespace App\Constant;

class Jurusan
{
    const IF = 1;
    const SI = 2;

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
            self::IF => "Informatika",
            self::SI => "Sistem Informasi"
        ];
    }
}
