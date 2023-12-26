<?php

namespace App\Models;

use App\Enums\TipoContato;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contato extends Model
{
    use HasFactory;

    protected $table = "contatos";


    protected $fillable = [
        "id_usuario",
        "id_empresa",
        "tipo_contato",
        "telefone",
        "email",
        "celular",
        "whatsapp",
        "facebook",
        "instagram",
        "linkedin"
    ];

    protected $cast = [
        'tipo_contato' => TipoContato::class,
    ];
    
    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getTipoContatoAttribute(string $value) : string {
        return getStatusTipoContato($value);
    }

    // public function tipo_contato(): Attribute 
    // {
    //     return Attribute::make(
    //         set: fn (TipoContato $status) => $status->name,
    //     );
    // }
}
