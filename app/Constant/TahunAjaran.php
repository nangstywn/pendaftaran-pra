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
        $date = date('Y-m-d');
        if ($date >= date('Y') . '-07-10' && $date <= date('Y') . '-12-31') {
            $ta = date('Y') . '/' . date('Y', strtotime('+1 year'));
        } else {
            $ta = date('Y', strtotime('-1 year')) . '/' . date('Y');
        }
        return [
            self::GASAL => "Gasal " . $ta,
            self::GENAP => "Genap " . $ta,
        ];
    }
}
