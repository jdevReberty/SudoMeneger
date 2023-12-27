<?php

namespace App\Enums;

enum TipoDocumento: string
{
    case venda = "Venda";
    case compra = "Compra";
    case pagamento_funcionario = "Pagamento de Funcionário";
    case declaracao = "Declaração";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}
