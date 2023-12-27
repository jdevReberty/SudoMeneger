<?php

namespace App\Models;

use App\Enums\ServicoStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servico extends Model
{
    use HasFactory;

    protected $fillable = [
        'id_empresa', 'orcamento_previo',
        'orcamento_final','status','descricao',
    ];

    protected $cast = [
        'status' => ServicoStatus::class
    ];

    public function getStatusAttribute($value) {
        return getStatusServico($value);
    }

    public function empresa() {
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }
}
