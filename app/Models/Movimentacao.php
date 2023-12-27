<?php

namespace App\Models;

use App\Enums\TipoMovimentacao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empresa',
        'id_servico',
        'id_usuario',
        'tipo_movimentacao',
        'valor',
    ];

    protected $cast = [
        'tipo_movimentacao' => TipoMovimentacao::class
    ];

    public function getTipoMovimentacaoAttribute($value) {
        return getTipoMovimentacao($value);
    }

    public function empresa() {
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }
    public function servico() {
        return $this->hasOne(Servico::class, 'id', 'id_empresa');
    }
    public function usuario() {
        return $this->hasOne(User::class, 'id', 'id_empresa');
    }
}
