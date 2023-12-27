<?php

namespace App\Enums;

enum TipoMovimentacao : string
{
    case pagamento_funcionario = "Pagamento de Funcionário";
    case compra = "Compra";
    case venda = "Venda";

    public static function fromValue(string $name) : string {
        foreach(self::cases() as $case) {
            if($case->name == $name) return $case->value;
        }
        return "undefined";
    }
}
