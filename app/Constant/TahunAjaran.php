<?php

namespace App\Constant;

class TahunAjaran
{
    const GASAL = 1;
    const GENAP = 2;

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
            self::GASAL => "Gasal",
            self::GENAP => "Genap",
        ];
    }
}
