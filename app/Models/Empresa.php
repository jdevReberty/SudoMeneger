<?php

namespace App\Models;

use App\Enums\TipoEmpresa;
use App\Models\Assets\TipoEmpresa as AssetsTipoEmpresa;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $table = "empresas";

    protected $fillable = [
      "nome","id_tipo_empresa","cnpj"  
    ];

    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getIdTipoEmpresaAttribute(string $value) : string {
        return getStatusTipoEmpresa(AssetsTipoEmpresa::where('id', $value)->first()->nome);
    }
    public function usuarioEmpresa() {
        return $this->hasMany(UsuarioEmpresa::class, 'id_empresa', 'id');
    }
    public function servicos() {
        return $this->hasMany(Servico::class, 'id_empresa', 'id');
    }
    public function contato() {
        return $this->hasMany(Contato::class, 'id_empresa', 'id');
    }
    public function endereco() {
        return $this->hasMany(Endereco::class, 'id_empresa', 'id');
    }
    public function movimentacao() {
        return $this->hasMany(Movimentacao::class, 'id_empresa', 'id');
    }
    public function tipoEmpresa() {
        return $this->hasOne(AssetsTipoEmpresa::class, 'id', 'id_tipo_empresa');
    }

}
