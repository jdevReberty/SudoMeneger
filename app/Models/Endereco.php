<?php

namespace App\Models;

use App\Enums\TipoEndereco;
use App\Models\Assets\TipoEnderecoContato;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $table = "enderecos";

    protected $fillable = [
        "id_usuario",
        "id_empresa",
        "id_tipo_endereco_contato",
        "logradouro",
        "numero",
        "bairro",
        "cep",
        "cidade",
        "estado",
      ];

    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getIdTipoEnderecoAttribute(string $value) : string {
        return getStatusTipoEndereco(TipoEnderecoContato::where('id', $value)->first()->nome);
    }

    public function tipoEnderecoContato() {
        return $this->hasOne(TipoEnderecoContato::class, 'id', 'id_tipo_endereco_contato');
    }
}
