<?php

namespace App\Models\Assets;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoDocumentacao extends Model
{
    use HasFactory;

    protected $table = "tipo_documentacao";

    protected $fillable = ['id', 'nome'];
}
