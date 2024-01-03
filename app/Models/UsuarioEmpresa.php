<?php

namespace App\Models;

use App\Enums\UsuarioEmpresaStatus;
use App\Models\Assets\TipoVinculo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioEmpresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "usuario_empresa";
    
    protected $fillable = [
        "id", "id_usuario", "id_empresa", "id_tipo_vinculo", "status" 
    ];

    // protected $foreign = ["id_usuario", "id_empresa", "id_tipo_vinculo"];

    protected $cast = [
        'status' => UsuarioEmpresaStatus::class
    ];

    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getIdTipoVinculoAttribute(string $value) : string {
        return getStatusTipoVinculoEmpresa(TipoVinculo::where('id', $value)->first()->nome);
    }
    public function getCreatedAtAttribute($value) {
        return date('d/m/Y H:m', strtotime($value));
    }

    public function getUpdatedAtAttribute($value) {
        return date('d/m/Y H:m', strtotime($value));
    }
    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getStatusAttribute(string $value) : string {
        return getStatusUsuarioEmpresa($value);
    }
    public function empresa() {
        return $this->hasOne(Empresa::class, "id", "id_empresa");
    }
    public function usuario() {
        return $this->hasOne(User::class, "id", "id_usuario");
    }
    public function tipoVinculo() {
        return $this->hasOne(TipoVinculo::class, 'id', 'id_tipo_vinculo');
    }
}
