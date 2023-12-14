<?php

namespace App\Models;

use App\Enums\TipoEndereco;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endereco extends Model
{
    use HasFactory;

    protected $fillable = [
        "id_usuario",
        "id_empresa",
        "tipo_endereco",
        "logradouro",
        "numero",
        "bairro",
        "cep",
        "cidade",
        "estado",
      ];

    protected $cast = [
        'tipo_endereco' => TipoEndereco::class,
    ];

    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getTipoEnderecoAttribute(string $value) : string {
        return getStatusTipoEndereco($value);
    }
}
