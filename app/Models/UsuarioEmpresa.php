<?php

namespace App\Models;

use App\Enums\EmpresaTipoVinculo;
use App\Enums\UsuarioEmpresaStatus;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UsuarioEmpresa extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = "usuario_empresa";
    
    protected $fillable = [
        "id", "id_usuario", "id_empresa", "tipo_vinculo", "status" 
    ];

    protected $foreign = ["id_usuario", "id_empresa",];

    protected $cast = [
        'tipo_vinculo' => EmpresaTipoVinculo::class,
        'status' => UsuarioEmpresaStatus::class
    ];

    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getTipoVinculoAttribute(string $value) : string {
        return getStatusTipoVinculoEmpresa($value);
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
}
