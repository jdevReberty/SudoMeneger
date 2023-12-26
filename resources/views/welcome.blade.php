@extends('layouts.default_layout')

@section('title_page', "Dashboard")

@section('content')
    @if ($contemEmpresa == false)
        <div class="d-flex justify-content-end mb-2">
            <a class="btn btn-sm btn-primary" href="{{route('empresa.create')}}">
                Vincular Empresa  
            </a>
        </div> 
        <!-- Default Card Example -->
        <div class="card shadow mb-4">
            <div class="card-header py-3">
               <h6 class="m-0 font-weight-bold text-primary">Nenhuma empresa vinculada!</h6>
            </div>
            <div class="card-body">
                Não foi encontrada nenhuma empresa vinculada, clique no botão acima "Vincular Empresa"
                para solicitar vínculo em uma empresa existante ou cadastrar a sua! 
            </div>
        </div>
    @else
        @foreach (Auth::user()->usuarioEmpresas()->get() as $usuario_empresa)
            @php
                $empresa = $usuario_empresa->empresa()->first();
            @endphp
            <div class="card shadow mb-4 p-1">
                <div class="d-flex justify-content-between align-items-center mb-2 mx-2">
                    <h1 class="h3 text-gray-800">{{$empresa->nome}}</h1>
                    @if ($usuario_empresa->tipo_vinculo == App\Enums\EmpresaTipoVinculo::titular->value)
                        <div class="d-flex justify-content-end">
                            <a class="btn btn-sm btn-success" href="#">
                                Gerenciar Empresa  
                            </a>
                        </div> 
                    @endif
                </div>
                <hr>
                <h1 class="h3 text-gray-800 mx-2 mb-4">Ações</h1>
                <div class="d-grid">
                    @if ($empresa->tipo_empresa == App\Enums\TipoEmpresa::servico->value)
                        <x-dashboard.item_acao titulo="Gerenciar Serviços" link="#"/>
                    @else 
                        <x-dashboard.item_acao titulo="Gerenciar movimentações" link="#"/>
                    @endif
                    <x-dashboard.item_acao titulo="Financeiro" link="#"/>
                    <x-dashboard.item_acao titulo="Gerenciar Nota Fiscal" link="#"/>
                    <x-dashboard.item_acao titulo="Inserir Comprovante" link="#"/>
                </div>
            </div>
        @endforeach
    @endif
@endsection