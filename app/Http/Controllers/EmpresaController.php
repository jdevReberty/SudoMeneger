<?php

namespace App\Http\Controllers;

use App\Enums\EmpresaTipoVinculo;
use App\Enums\UsuarioEmpresaStatus;
use App\Http\Requests\CreateEmpresaRequest;
use App\Models\{Contato, Empresa, Endereco, UsuarioEmpresa};
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class EmpresaController extends Controller
{
    public function __construct(
        protected Empresa $empresa,
        protected Contato $contato,
        protected Endereco $endereco,
        protected UsuarioEmpresa $usuarioEmpresa,
    ){}

    public function index(Empresa $empresa) {
        $empresa->with(['contato', 'endereco']);
        return view('pages.empresa.index', compact('empresa'));
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

    public function create_contato(Empresa $empresa) {
        return view('pages.contato.empresa.create', compact('empresa'));
    }

    public function store_contato(Request $request, Empresa $empresa) {
        try {
            $request['id_empresa'] = $empresa->id;
            $request['tipo_contato'] = 'profissional';
            $this->contato->create($request->toArray());
            return redirect()->route('empresa.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function create_endereco(Empresa $empresa) {
        return view('pages.endereco.empresa.create', compact('empresa'));
    }

    public function store_endereco(Request $request, Empresa $empresa) {
        try {
            $request['id_empresa'] = $empresa->id;
            $request['tipo_endereco'] = 'profissional';
            $this->endereco->create($request->toArray());
            return redirect()->route('empresa.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}
