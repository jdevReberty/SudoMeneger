<?php

namespace App\Enums;

enum UsuarioEmpresaStatus: string 
{
    case ativo = "Ativo";
    case finalizado = "Recidido";
    case pendente = "Pendente";
    case negado = "Negado";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}