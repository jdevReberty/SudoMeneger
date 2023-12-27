@extends('layouts.default_layout')

@section('title_page', "Dashboard")

@section('content')
    @if ($podeVincular)   
        <div class="d-flex justify-content-end mb-2">
            <a class="btn btn-sm btn-primary" href="{{route('empresa.create')}}">
                Vincular Empresa  
            </a>
        </div> 
    @endif
    @if ($contemEmpresa == false)
        <!-- Default Card Example -->
        <div class="card shadow mb-4 mx-0 ">
            <!-- Card Header - Accordion -->
            <a href="#nenhumaEmpresaVinculada" class="d-block card-header py-3" data-toggle="collapse"
                role="button" aria-expanded="true" aria-controls="nenhumaEmpresaVinculada">
                <h3 class="m-0 font-weight-bold text-primary">Nenhuma empresa vinculada!</h3>
            </a>
            <!-- Card Content - Collapse -->
            <div class="collapse show" id="nenhumaEmpresaVinculada">
                <div class="card-body">
                    Não foi encontrada nenhuma empresa vinculada, clique no botão acima "Vincular Empresa"
                    para solicitar vínculo em uma empresa existante ou cadastrar a sua! 
                </div>
            </div>
        </div>
    @else
        @foreach (Auth::user()->usuarioEmpresas()->orderBy('id','desc')->get() as $key => $usuario_empresa)
            @php
                $empresa = $usuario_empresa->empresa()->first();
            @endphp
            @if ($usuario_empresa->status == "Ativo")
                <div class="card shadow mb-4 mx-0 ">
                    <!-- Card Header - Accordion -->
                    <a href="#empresa{{ $usuario_empresa->id }}" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="empresa{{ $usuario_empresa->id }}">
                        <h3 class="m-0 font-weight-bold text-primary">{{$empresa->nome}}</h3>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="empresa{{ $usuario_empresa->id }}">
                        <div class="card-body">
                            @if ($usuario_empresa->tipo_vinculo == App\Enums\EmpresaTipoVinculo::titular->value)
                                <div class="d-flex justify-content-end">
                                    <a class="btn btn-sm btn-success" href="{{ route('empresa.index', ['empresa' => $empresa->id]) }}">
                                        Gerenciar Empresa  
                                    </a>
                                </div> 
                            @endif
                            <hr>
                            <h1 class="h3 text-gray-800 mx-2 mb-4">Ações</h1>
                            <div class="d-grid">
                                <x-dashboard.item_acao titulo="Financeiro" link="{{ route('movimentacao.index', ['empresa' => $empresa->id]) }}"/>
                                <x-dashboard.item_acao titulo="Documentação" link="#" classContent="secondary disabled"/>
                                @if ($empresa->tipo_empresa == App\Enums\TipoEmpresa::servico->value)
                                    <x-dashboard.item_acao titulo="Gerenciar Serviços" link="{{ route('servico.index', ['empresa' => $empresa->id]) }}"/>
                                @elseif($empresa->tipo_empresa == App\Enums\TipoEmpresa::comercio->value)
                                    <x-dashboard.item_acao titulo="Relatórios de Vendas" link="#" classContent="secondary disabled"/>
                                    <x-dashboard.item_acao titulo="Relatórios de Compras" link="#" classContent="secondary disabled"/>
                                @else
                                    <x-dashboard.item_acao titulo="Gerenciar Serviços" link="#" classContent="secondary disabled"/>
                                    <x-dashboard.item_acao titulo="Relatórios de Vendas" link="#" classContent="secondary disabled"/>
                                    <x-dashboard.item_acao titulo="Relatórios de Compras" link="#" classContent="secondary disabled"/>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($usuario_empresa->status == "Pendente")
                @php
                    $titular = $empresa->usuarioEmpresa()->where('tipo_vinculo', 'titular')->first()->usuario;
                @endphp
                <div class="card shadow mb-4 mx-0 ">
                    <!-- Card Header - Accordion -->
                    <a href="#empresa{{ $usuario_empresa->id.$key }}" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="empresa{{ $usuario_empresa->id.$key }}">
                        <h3 class="m-0 font-weight-bold text-warning">{{$empresa->nome}}</h3>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="empresa{{ $usuario_empresa->id.$key }}">
                        <div class="card-body">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                   <h6 class="m-0 font-weight-bold text-warning">Esperando confirmação</h6>
                                </div>
                                <div class="card-body">
                                    O titular: <strong>{{ $titular->name }}</strong> da empresa: <strong>{{ $empresa->nome }}</strong> ainda não aceitou
                                    a sua solicitação de vínculo!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($usuario_empresa->status == 'Negado')
                @php
                    $titular = $empresa->usuarioEmpresa()->where('tipo_vinculo', 'titular')->first()->usuario;
                @endphp
                <div class="card shadow mb-4 mx-0 ">
                    <!-- Card Header - Accordion -->
                    <a href="#empresa{{ $usuario_empresa->id.$key }}" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="empresa{{ $usuario_empresa->id.$key }}">
                        <h3 class="m-0 font-weight-bold text-danger">{{$empresa->nome}}</h3>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="empresa{{ $usuario_empresa->id.$key }}">
                        <div class="card-body">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Vinculo negado</h6>
                                </div>
                                <div class="card-body">
                                    O titular: <strong>{{ $titular->name }}</strong> da empresa: <strong>{{ $empresa->nome }}</strong> 
                                    negou a sua solicitação de vínculo!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @elseif($usuario_empresa->status == 'Recidido')
                @php
                    $titular = $empresa->usuarioEmpresa()->where('tipo_vinculo', 'titular')->first()->usuario;
                @endphp
                <div class="card shadow mb-4 mx-0 ">
                    <!-- Card Header - Accordion -->
                    <a href="#empresa{{ $usuario_empresa->id.$key }}" class="d-block card-header py-3" data-toggle="collapse"
                        role="button" aria-expanded="true" aria-controls="empresa{{ $usuario_empresa->id.$key }}">
                        <h3 class="m-0 font-weight-bold text-danger">{{$empresa->nome}}</h3>
                    </a>
                    <!-- Card Content - Collapse -->
                    <div class="collapse show" id="empresa{{ $usuario_empresa->id.$key }}">
                        <div class="card-body">
                            <div class="card shadow mb-4">
                                <div class="card-header py-3">
                                    <h6 class="m-0 font-weight-bold text-danger">Vinculo Finalizado</h6>
                                </div>
                                <div class="card-body">
                                    O titular: <strong>{{ $titular->name }}</strong> da empresa: <strong>{{ $empresa->nome }}</strong> 
                                    Recindiu o se vínculo com a Empresa!
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        @endforeach
    @endif
@endsection