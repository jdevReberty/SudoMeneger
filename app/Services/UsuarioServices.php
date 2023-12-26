<?php

namespace App\Services;

use App\Models\Empresa;
use App\Models\User;
use App\Models\UsuarioEmpresa;
use Illuminate\Support\Facades\Auth;

class UsuarioServices {

    public function __construct(
        protected UsuarioEmpresa $usuarioEmpresa, 
        protected Empresa $empresa, 
        protected User $usuario
    ){}

    public function contemEmpresa() : bool{
        $this->usuario = Auth::user();
        if($this->usuario->usuarioEmpresas()->get()->isEmpty()) return false;
        return true;
    }

    public static function usuarioPossuiEmpresaTitular(User $usuario = null) : bool {
        $usuario = $usuario ?? Auth::user();
        if(
            $usuario->usuarioEmpresas()
                ->where('tipo_vinculo', 'titular')
                ->where('status', 'ativo')
                ->get()->isEmpty()
        ) {
            return false;
        }

        return true;
    }
}