<?php

namespace App\Models;

use App\Enums\TipoDocumento;
use App\Models\Assets\TipoDocumentacao;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documentacao extends Model
{
    use HasFactory;
    
    protected $fillable = [
        'id_empresa',
        'id_servico',
        'id_tipo_documentacao',
        'path',
    ];

    public function getIdTipoDocumentoAttribute($value) {
        return getTipoDocumento(TipoDocumentacao::where('id', $value)->first()->nome);
    }
    public function empresa() {
        return $this->hasOne(Empresa::class, 'id', 'id_empresa');
    }
    public function servico() {
        return $this->hasOne(Servico::class, 'id', 'id_empresa');
    }
    public function tipoDocumentacao() {
        return $this->hasOne(TipoDocumentacao::class, 'id', 'id_tipo_documentacao');
    }
}
