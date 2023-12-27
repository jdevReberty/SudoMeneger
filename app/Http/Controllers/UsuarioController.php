<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Endereco;
use App\Models\User;
use App\Models\UsuarioEmpresa;
use Illuminate\Http\Request;

class UsuarioController extends Controller
{
    public function __construct(
        protected User $usuario,
        protected Contato $contato,
        protected Endereco $endereco,
        protected UsuarioEmpresa $usuarioEmpresa,
    ){}

    public function index(User $usuario) {
        $usuario->with(['contato', 'endereco']);
        return view('pages.usuario.index', compact('usuario'));
    }
    public function create_contato(User $usuario) {
        return view('pages.contato.usuario.create', compact('usuario'));
    }
    public function store_contato(Request $request, User $usuario) {
        try {
            $request['id_usuario'] = $usuario->id;
            $request['tipo_contato'] = 'pessoal';
            $this->contato->create($request->toArray());
            return redirect()->route('usuario.index', ['usuario' => $usuario->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    public function create_endereco(User $usuario) {
        return view('pages.endereco.usuario.create', compact('usuario'));
    }
    public function store_endereco(Request $request, User $usuario) {
        try {
            $request['id_usuario'] = $usuario->id;
            $request['tipo_endereco'] = 'pessoal';
            $this->endereco->create($request->toArray());
            return redirect()->route('usuario.index', ['usuario' => $usuario->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}
