<?php

namespace App\Enums;

enum ServicoStatus: string 
{
    case ativo = "Aberto";
    case fechado = "Fechado";
    case reaberto = "Reaberto";
    case cancelado = "Cancelado";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}
