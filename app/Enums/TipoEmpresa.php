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

    public static function TiposEmpresa() {
        return [
            (Object)['value' => 1, 'name' => self::comercio->value],
            (Object)['value' => 2, 'name' => self::servico->value],
            (Object)['value' => 3, 'name' => self::comercio_servico->value],
        ];
    }
}