<?php

namespace App\Enums;

enum TipoEmpresa: string 
{
    case comercio = "Comércio";
    case servico = "Serviço";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}