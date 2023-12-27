<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Servico;
use Illuminate\Http\Request;

class ServicoController extends Controller
{
    public function index(Empresa $empresa) {
        $empresa->with('servicos');
        return view('pages.servicos.index', compact('empresa'));
    }
    public function create(Empresa $empresa) {
        return view('pages.servicos.create', compact('empresa'));
    }
    public function store(Request $request, Empresa $empresa) {
        try {
            $request['id_empresa'] = $empresa->id;
            $request['status'] = 'ativo';
            Servico::create($request->toArray());
            return redirect()->route('servico.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    public function edit(Empresa $empresa, Servico $servico) {
        return view('pages.servicos.edit', compact('empresa', 'servico'));

    }
    public function update(Request $request, Empresa $empresa, Servico $servico) {
        try {
            $servico->update($request->toArray());
            return redirect()->route('servico.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    public function finalizar(Empresa $empresa, Servico $servico) {
        try {
            $servico->update([
                'status' => 'fechado',
                'orcamento_final' => $servico->orcamento_final ?? $servico->orcamento_previo,
            ]);
            return redirect()->route('servico.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    public function cancelar(Empresa $empresa, Servico $servico) {
        try {
            $servico->update(['status' => 'cancelado']);
            return redirect()->route('servico.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
    public function reabrir(Empresa $empresa, Servico $servico) {
        try {
            $servico->update(['status' => 'reaberto']);
            return redirect()->route('servico.index', ['empresa' => $empresa->id]);
        } catch (\Throwable $th) {
            return redirect()->back()->withErrors(['errors' => $th->getMessage()]);
        }
    }
}
