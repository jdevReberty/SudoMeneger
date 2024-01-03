@extends('layouts.default_layout')

@section('title_page')
    <div class="d-flex mb-0">
        <h3 class="h3 text-gray-800">Movimentações&nbsp;>></h3>
        <h3 class="h3 text-gray-800">&nbsp;{{ $empresa->nome }}</h3>
    </div>
@endsection

@section('content')
    <div class="d-flex justify-content-end mb-2">
        <div class="dropdown">
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdawnMovimentacao" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Cadastrar Movimentacão
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdawnMovimentacao">
              <a class="dropdown-item" href="{{ route('movimentacao.create_movimentacao_comercio', ['empresa' => $empresa->id]) }}">Compra ou Venda</a>
              <a class="dropdown-item" href="{{ route('movimentacao.create_pagamento_funcionario', ['empresa' => $empresa->id]) }}">Pagamento de Funcionario</a>
            </div>
        </div>
    </div>

    <div class="card shadow mb-4">
        <div class="py-2 pl-3">
            <x-alert :errors="$errors" :errorCount="$errors->count()" />
        </div>
        @if ($empresa->movimentacao->isEmpty())
            <div class="card shadow mb-4 mx-0 ">
                <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Nenhuma Movimentacao cadastrada</h6>
                </div>
            </div>
        @else
            <div class="table-responsive mt-3 px-2">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Tipo Movimentação</th>
                            <th>Valor</th>
                            <th>Beneficiário</th>
                            <th>Data</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($empresa->movimentacao as $key => $movimentacao)
                            @php
                                // dd($movimentacao->usuario);
                                // // $usuario_titular = $empresa->usuarioEmpresa()
                                // //     ->where('tipo_vinculo', 'titular')->first()
                                // //     ->usuario()->first();
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $movimentacao->id_tipo_movimentacao }}</td>
                                <td>{{ $movimentacao->valor }}</td>
                                <td>
                                    {{ 
                                        ($movimentacao->id_tipo_movimentacao == "Pagamento de Funcionário") 
                                        ? $movimentacao->usuario->name
                                        : 
                                            (
                                                $movimentacao->id_tipo_movimentacao == "Compra"
                                                ? "Externo"
                                                : $empresa->nome
                                            )
                                    }}
                                </td>
                                <td>{{ $movimentacao->created_at }}</td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-warning" title="Editar Movimentação">
                                        <i class="fas fa-pen-square"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-danger" title="Excluir Movimentação">
                                        <i class="fas fa-trash"></i>
                                    </a>
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