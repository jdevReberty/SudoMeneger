<?php

namespace App\Enums;

enum UsuarioEmpresaStatus: string 
{
    case ativo = "Ativo";
    case finalizado = "Recidido";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}