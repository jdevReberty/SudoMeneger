<?php

namespace App\Models;

use App\Enums\TipoContato;
use App\Models\Assets\TipoEnderecoContato;
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
        "id_tipo_endereco_contato",
        "telefone",
        "email",
        "celular",
        "whatsapp",
        "facebook",
        "instagram",
        "linkedin"
    ];

    /**
     * Accesor to convert value by column to unum
     *
     * @param string $value
     * @return string
     */
    public function getIdTipoContatoAttribute(string $value) : string {
        return getStatusTipoContato(TipoEnderecoContato::where('id', $value)->first()->nome);
    }

    public function tipoEnderecoContato() {
        return $this->hasOne(TipoEnderecoContato::class, 'id', 'id_tipo_endereco_contato');
    }

    // public function tipo_contato(): Attribute 
    // {
    //     return Attribute::make(
    //         set: fn (TipoContato $status) => $status->name,
    //     );
    // }
}
