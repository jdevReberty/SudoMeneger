@extends('layouts.default_layout')

@section('title_page')
    <div class="d-flex mb-0">
        <h3 class="h3 text-gray-800">Serviços&nbsp;>></h3>
        <h3 class="h3 text-gray-800">&nbsp;{{ $empresa->nome }}</h3>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-end mb-2">
        {{-- <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdawnMovimentacao" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Cadastrar Serviço
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdawnMovimentacao">
              <a class="dropdown-item" href="{{ route('movimentacao.create_movimentacao_comercio', ['empresa' => $empresa->id]) }}">Compra ou Venda</a>
              <a class="dropdown-item" href="{{ route('movimentacao.create_pagamento_funcionario', ['empresa' => $empresa->id]) }}">Pagamento de Funcionario</a>
            </div>
        </div> --}}
        <a href="{{ route('servico.create', ['empresa' => $empresa->id]) }}" class="btn btn-primary" >
            Cadastrar Serviço
        </a>
    </div>

    <div class="card shadow mb-4">
        <div class="py-2 pl-3">
            <x-alert :errors="$errors" :errorCount="$errors->count()" />
        </div>
        @if ($empresa->servicos->isEmpty())
            <div class="card shadow mb-4 mx-0 ">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nenhum serviço cadastrado</h6>
                </div>
            </div>
        @else
            <div class="table-responsive mt-3 px-2">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Orçamento inicial</th>
                            <th>Orçamento Final</th>
                            <th>Status</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresa->servicos as $key => $servico)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $servico->orcamento_previo }}</td>
                                <td>{{ $servico->orcamento_final ?? 'A definir' }}</td>
                                <td>{{ $servico->status }}</td>
                                <td>{{ $servico->created_at }}</td>
                                <td>
                                    @if ($servico->status == "Aberto")
                                        <a href="{{ route('servico.edit', ['empresa' => $empresa->id, 'servico' => $servico->id]) }}" class="btn btn-sm btn-warning" title="Editar Serviço">
                                            <i class="fas fa-pen-square"></i>
                                        </a>
                                        <a href="{{ route('servico.finalizar', ['empresa' => $empresa->id, 'servico' => $servico->id]) }}" class="btn btn-sm btn-info" title="Finalizar Serviço">
                                            <i class="fas fa-lock"></i>
                                        </a>
                                        <a href="{{ route('servico.cancelar', ['empresa' => $empresa->id, 'servico' => $servico->id]) }}" class="btn btn-sm btn-danger" title="Cancelar Serviço">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    @elseif($servico->status == "Reaberto")
                                        <a href="{{ route('servico.edit', ['empresa' => $empresa->id, 'servico' => $servico->id]) }}" class="btn btn-sm btn-warning" title="Editar Serviço">
                                            <i class="fas fa-pen-square"></i>
                                        </a>
                                        <a href="{{ route('servico.finalizar', ['empresa' => $empresa->id, 'servico' => $servico->id]) }}" class="btn btn-sm btn-info" title="Finalizar Serviço">
                                            <i class="fas fa-lock"></i>
                                        </a>
                                    @elseif($servico->status == "Fechado")
                                        <a href="{{ route('servico.reabrir', ['empresa' => $empresa->id, 'servico' => $servico->id]) }}" class="btn btn-sm btn-info" title="Reabrir Serviço">
                                            <i class="fas fa-unlock"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
        {{-- <div class="card-body">
            <x-alert :errors="$errors" :errorCount="$errors->count()" />
            <form method="post">
                @csrf
                <x-form.input name="name" value="{{$usuario->name}}" label="Nome" type="text" required="true" readonly="true" placeholder="Nome completo"  contentClass=""/>
                <x-form.input name="email" value="{{$usuario->email}}" label="Email" type="text" required="true" readonly="true" placeholder="Ex:. exemplo@exemplo.com"  contentClass=""/>
                <x-form.input name="email" value="" label="CPF" type="text" required="true" readonly="true" placeholder="Ex:. 000.000.000-00"  contentClass=""/>
            </form>
        </div> --}}
        {{-- <!-- Card Header - Accordion -->
        <a href="#collapseDadosGerais" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseDadosGerais">
            <h3 class="m-0 font-weight-bold text-primary">Dados Gerais do Usuario</h3>
        </a> --}}
        <!-- Card Content - Collapse -->
        {{-- <div class="collapse show" id="collapseDadosGerais">
            
        </div> --}}
    </div>    
@endsection