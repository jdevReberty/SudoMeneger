<?php

namespace App\Models;

use App\Enums\TipoDocumento;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacao extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_empresa',
        'id_servico',
        'tipo_documento',
        'path',
    ];

    protected $cast = [
        'tipo_documento' => TipoDocumento::class
    ];

    public function getTipoDocumentoAttribute($value) {
        return getTipoDocumento($value);
    }

    public function empresa() {
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }
    public function servico() {
        return $this->hasOne(Servico::class, 'id', 'id_empresa');
    }
}
