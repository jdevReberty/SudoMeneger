<?php

namespace App\Models\Assets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoMovimentacao extends Model
{
    use HasFactory;

    protected $table = "tipo_movimentacao";

    protected $fillable = ['id', 'nome'];
}
