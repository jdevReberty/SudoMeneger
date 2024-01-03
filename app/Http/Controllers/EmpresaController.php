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
        try {
            $podeVincular = Auth::user()->usuarioEmpresas()
                ->whereIn('id_tipo_vinculo', ['1', '2'])
                ->whereIn('status', ['ativo, pendente'])->get()->count() < 2;

            if($podeVincular) {
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
            } else {
                throw new \Exception('Você já atingiu o limite de solicitação de vinculo ou cadastro de CNPJ');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function store(CreateEmpresaRequest $request) {
        try {
            DB::beginTransaction();
            $empresa = $this->empresa->create([
                "nome" => $request->name,
                "id_tipo_empresa" => $request->tipo_empresa,
                "cnpj" => $request->cnpj,
            ]);
            $this->usuarioEmpresa->create([
                "id_usuario" => Auth::user()->id,
                "id_empresa" => $empresa->id,
                "id_tipo_vinculo" => 1, //titular
                "status" => UsuarioEmpresaStatus::ativo->name,
            ]);
            DB::commit();

            return redirect()->route("home");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(["errors" => $th->getMessage()])->withInput();
        }
    }

    public function solicitar_vinculo(Empresa $empresa) {
        try {
            $current = $this->usuarioEmpresa
                ->where('id_usuario', Auth::user()->id)
                ->where('id_empresa', $empresa->id)
                ->get()->last();

            if($current == null || $current->status == 'Recidido') {
                $this->usuarioEmpresa->create([
                    "id_usuario" => Auth::user()->id,
                    "id_empresa" => $empresa->id,
                    "id_tipo_vinculo" => 2, //funcionario
                    "status" => UsuarioEmpresaStatus::pendente->name,
                ]);
            } elseif($current->status == 'Negado') {
                $current->update([
                    "status" => UsuarioEmpresaStatus::pendente->name,
                ]);
            } else {
                throw new \Exception("Não é possível solicitar vínculo novamente!");
            }
            return redirect()->route("home");
        } catch (\Throwable $th) {
            DB::rollBack();
            return redirect()->back()->withErrors(["errors" => $th->getMessage()])->withInput();
        }
    }

    public function aceitar_vinculo(UsuarioEmpresa $usuarioEmpresa) {
        try {
            if($usuarioEmpresa->status != 'Pendente') throw new \Exception("Solicitação já Finalizada!");
            $usuarioEmpresa->update(['status' => 'ativo']);
            return redirect()->route('empresa.index', ['empresa' => $usuarioEmpresa->id_empresa]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function negar_vinculo(UsuarioEmpresa $usuarioEmpresa) {
        try {
            if($usuarioEmpresa->status != 'Pendente') throw new \Exception("Solicitação já Finalizada!");
            $usuarioEmpresa->update(['status' => 'negado']);
            return redirect()->route('empresa.index', ['empresa' => $usuarioEmpresa->id_empresa]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function recidir_vinculo(UsuarioEmpresa $usuarioEmpresa) {
        try {
            if($usuarioEmpresa->status != 'Ativo') throw new \Exception("Não é possível recindir um funcionário que não está Ativo!");
            $usuarioEmpresa->update(['status' => 'finalizado']);
            return redirect()->route('empresa.index', ['empresa' => $usuarioEmpresa->id_empresa]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }

    public function create_contato(Empresa $empresa) {
        return view('pages.contato.empresa.create', compact('empresa'));
    }

    public function store_contato(Request $request, Empresa $empresa) {
        try {
            $request['id_empresa'] = $empresa->id;
            $request['id_tipo_endereco_contato'] = 2; //profissional
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
            $request['id_tipo_endereco_contato'] = 2; //profissional
            $this->endereco->create($request->toArray());
            return redirect()->route('empresa.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}
