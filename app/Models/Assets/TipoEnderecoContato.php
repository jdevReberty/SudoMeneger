<?php

namespace App\Models\Assets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoEnderecoContato extends Model
{
    use HasFactory;

    protected $table = "tipo_endereco_contato";

    protected $fillable = ['id', 'nome'];
}
