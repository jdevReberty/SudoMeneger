<?php

namespace App\Http\Controllers;

use App\Enums\EmpresaTipoVinculo;
use App\Enums\UsuarioEmpresaStatus;
use App\Http\Requests\CreateEmpresaRequest;
use App\Models\Empresa;
use App\Models\UsuarioEmpresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    public function __construct(
        protected Empresa $empresa,
        protected UsuarioEmpresa $usuarioEmpresa,
    ){}

    public function index() {

    }

    public function create(Request $request) {
        $method = $request->method();
        if($method != "GET") {
            $empresas = $this->empresa->where("cnpj", "like", "%$request->cnpj%")->get();
            $search = (Object)[
                "pesquisa" => $request->cnpj,
                "empresas" => $empresas
            ];
            return view("pages.empresa.create", compact('search'));
        }
        return view("pages.empresa.create");
    }

    public function store(CreateEmpresaRequest $request) {
        try {
            DB::beginTransaction();
            $empresa = $this->empresa->create([
                "nome" => $request->name,
                "tipo_empresa" => $request->tipo_empresa,
                "cnpj" => $request->cnpj,
            ]);
            $this->usuarioEmpresa->create([
                "id_usuario" => Auth::user()->id,
                "id_empresa" => $empresa->id,
                "tipo_vinculo" => EmpresaTipoVinculo::titular->name, 
                "status" => UsuarioEmpresaStatus::ativo->name,
            ]);
            DB::commit();

            return redirect()->route("home");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(["errors" => $th->getMessage()])->withInput();
        }
    }
}
