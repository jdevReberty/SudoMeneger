<?php

namespace App\Models\Assets;

use App\Models\UsuarioEmpresa;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoVinculo extends Model
{
    use HasFactory;

    protected $table = "tipo_vinculo";
    protected $fillable = ["id", "nome"];
    protected $primaryKey = 'id';


    public function usuarioEmpresa() {
        return $this->hasMany(UsuarioEmpresa::class, 'id_tipo_vinculo', 'id');
    }
}
