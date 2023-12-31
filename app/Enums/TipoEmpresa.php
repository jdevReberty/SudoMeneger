<?php

namespace App\Enums;

enum TipoEmpresa: string 
{
    case comercio = "Comércio";
    case servico = "Serviço";
    case comercio_servico = "Serviço e Comércio";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}