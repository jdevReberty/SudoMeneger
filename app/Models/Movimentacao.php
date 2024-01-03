<?php

namespace App\Models;

use App\Enums\TipoMovimentacao;
use App\Models\Assets\TipoMovimentacao as AssetsTipoMovimentacao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movimentacao extends Model
{
    use HasFactory;

    protected $table = "movimentacoes";

    protected $fillable = [
        'id_empresa',
        'id_servico',
        'id_usuario',
        'id_tipo_movimentacao',
        'valor',
    ];

    public function getIdTipoMovimentacaoAttribute($value) {
        return getTipoMovimentacao(AssetsTipoMovimentacao::where('id', $value)->first()->nome);
    }
    public function getCreatedAtAttribute($value) {
        return date('d/m/Y H:m', strtotime($value));
    }
    public function empresa() {
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }
    public function servico() {
        return $this->hasOne(Servico::class, 'id', 'id_servico');
    }
    public function usuario() {
        return $this->hasOne(User::class, 'id', 'id_usuario');
    }
    public function tipoMovimentacao() {
        return $this->hasOne(AssetsTipoMovimentacao::class, 'id', 'id_tipo_movimentacao');
    }
}
