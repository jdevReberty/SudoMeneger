<?php

namespace App\Enums;

enum EmpresaTipoVinculo: string 
{
    case titular = "Titular";
    case funcionario = "Funcionario";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}