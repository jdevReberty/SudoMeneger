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

    
    public static function TiposMovimentacao() {
        return [
            (Object)['value' => 1, 'name' => self::pagamento_funcionario->value],
            (Object)['value' => 2, 'name' => self::compra->value],
            (Object)['value' => 3, 'name' => self::venda->value],
        ];
    }
}
