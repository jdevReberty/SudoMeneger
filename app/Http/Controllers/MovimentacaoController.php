<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Movimentacao;
use App\Models\Servico;
use Illuminate\Http\Request;

class MovimentacaoController extends Controller
{
    public function __construct(
        protected Movimentacao $movimentacao
    ){}
    public function index(Empresa $empresa) {
        $empresa->with('movimentacao');
        return view('pages.financeiro.index', compact('empresa'));
    }
    public function create_pagamento_funcionario(Empresa $empresa) {
        try {
            $funcionarios = $empresa->usuarioEmpresa()
                ->where('tipo_vinculo', 'funcionario')
                ->where('status', 'ativo')
                ->get();
            if($funcionarios->count() == 0) throw new \Exception("Não é possível cadastrar uma movimentação de pagamento quando não há funcionários vinculados");

            return view('pages.financeiro.funcionario.create', compact('empresa', 'funcionarios'));
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    public function store_pagamento_funcionario(Request $request, Empresa $empresa) {
        try {
            $request['id_empresa'] = $empresa->id;
            $request['tipo_movimentacao'] = "pagamento_funcionario";
            $this->movimentacao->create($request->toArray());
            return redirect()->route('movimentacao.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
        
    }
    public function create_movimentacao_comercio(Empresa $empresa) {
        return view('pages.financeiro.comercio.create', compact('empresa'));
    }
    public function store_movimentacao_comercio(Request $request, Empresa $empresa) {
        try {
            $request['id_empresa'] = $empresa->id;
            $this->movimentacao->create($request->toArray());
            return redirect()->route('movimentacao.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    public function create_movimentacao_servico(Servico $servico) {}
    public function store_movimentacao_servico(Request $request, Servico $servico) {}
}
