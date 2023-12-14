<?php

namespace App\Enums;

enum TipoEndereco: string 
{
    case pessoal = "Pessoal";
    case profissional = "Profissional";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}