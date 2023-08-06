<?php

namespace App\Constant;

class Jurusan
{
    const IF = 1;
    const SI = 2;
    const TK = 3;
    const RPLA = 4;
    const KA = 5;

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
            self::SI => "Sistem Informasi",
            self::TK => "Teknologi Komputer",
            self::RPLA => "Rekayasa Perangkat Lunak Aplikasi",
            self::KA => "Komputerisasi Akuntansi",
        ];
    }
}
