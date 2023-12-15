<?php

namespace App\Models;

use App\Enums\TipoEmpresa;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Empresa extends Model
{
    use HasFactory;

    protected $fillable = [
      "nome","tipo_empresa","cnpj"  
    ];

    protected $cast = [
        'tipo_empresa' => TipoEmpresa::class,
    ];

    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getTipoEmpresaAttribute(string $value) : string {
        return getStatusTipoEmpresa($value);
    }
}