@extends('layouts.default_layout')

@section('title_page')
    <div class="d-flex mb-0">
        <h3 class="h3 text-gray-800">&nbsp;{{ $usuario->name }}</h3>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4 mx-0 ">
        <!-- Card Header - Accordion -->
        <a href="#collapseDadosGerais" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseDadosGerais">
            <h3 class="m-0 font-weight-bold text-primary">Dados Gerais do Usuario</h3>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseDadosGerais">
            <div class="card-body">
                <x-alert :errors="$errors" :errorCount="$errors->count()" />
                <form method="post">
                    @csrf
                    <x-form.input name="name" value="{{$usuario->name}}" label="Nome" type="text" required="true" readonly="true" placeholder="Nome completo"  contentClass=""/>
                    <x-form.input name="email" value="{{$usuario->email}}" label="Email" type="text" required="true" readonly="true" placeholder="Ex:. exemplo@exemplo.com"  contentClass=""/>
                    <x-form.input name="email" value="" label="CPF" type="text" required="true" readonly="true" placeholder="Ex:. 000.000.000-00"  contentClass=""/>
                </form>
            </div>
        </div>
    </div>
    <div class="card shadow mb-4 mx-0 ">
        <!-- Card Header - Accordion -->
        <a href="#collapseContato" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseContato">
            <h3 class="m-0 font-weight-bold text-primary">Contato</h3>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseContato">
            <div class="card-body">
                @if ($usuario->contato->isEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Nenhum contato cadastrado!</h6>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p class="pb-0 mb-0 mr-2">
                                Deseja cadastrar um Contato?
                            </p>
                            <a href="{{ route('usuario.create_contato', ['usuario' => $usuario->id]) }}" class="btn btn-primary">
                                Cadastrar Contato
                            </a>
                        </div>
                    </div>
                @else
                    @foreach ($usuario->contato as $contato)
                        <x-form.input name="telefone" value="{{$contato->telefone}}" label="Telefone" type="text" required="false" readonly="true" placeholder="XXXXXXXX"  contentClass=""/>
                        <x-form.input name="email" value="{{$contato->email}}" label="Email" type="email" required="false" readonly="true" placeholder="exemplo@exemplo.com"  contentClass=""/>
                        <x-form.input name="celular" value="{{$contato->celular}}" label="Celular" type="text" required="false" readonly="true" placeholder="849XXXXXXXX"  contentClass=""/>
                        <x-form.input name="whatsapp" value="{{$contato->whatsapp}}" label="Whatsapp" type="text" required="false" readonly="true" placeholder="+55849XXXXXXXX"  contentClass=""/>
                        <x-form.input name="facebook" value="{{$contato->facebook}}" label="Facebook" type="text" required="false" readonly="true" placeholder="link do Facebook"  contentClass=""/>
                        <x-form.input name="instagram" value="{{$contato->instagram}}" label="Instagram" type="text" required="false" readonly="true" placeholder="@ do instagram"  contentClass=""/>
                        <x-form.input name="linkedin" value="{{$contato->linkedin}}" label="Linkedin" type="text" required="false" readonly="true" placeholder="Perfil do linkedin"  contentClass=""/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
    <div class="card shadow mb-4 mx-0 ">
        <!-- Card Header - Accordion -->
        <a href="#collapseEndereco" class="d-block card-header py-3" data-toggle="collapse"
            role="button" aria-expanded="true" aria-controls="collapseEndereco">
            <h3 class="m-0 font-weight-bold text-primary">Endereço</h3>
        </a>
        <!-- Card Content - Collapse -->
        <div class="collapse show" id="collapseEndereco">
            <div class="card-body">
                @if ($usuario->endereco->isEmpty())
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Nenhum endereço cadastrado!</h6>
                        </div>
                        <div class="card-body d-flex flex-column">
                            <p class="pb-0 mb-0 mr-2">
                                Deseja cadastrar um Endereço? 
                            </p>
                            <a href="{{ route('usuario.create_endereco', ['usuario' => $usuario->id]) }}" class="btn btn-primary">
                                Cadastrar Endereço
                            </a>
                        </div>
                    </div>
                @else
                    @php
                        // dd($usuario->endereco);
                    @endphp
                    @foreach ($usuario->endereco as $endereco)
                        <x-form.input name="logradouro" value="{{$endereco->logradouro}}" label="Logradouro" type="text" required="true" readonly="true" placeholder="Ex:. Rua exemplo"  contentClass=""/>
                        <x-form.input name="numero" value="{{$endereco->numero}}" label="Numero" type="text" required="true" readonly="true" placeholder="Ex:. 02"  contentClass=""/>
                        <x-form.input name="bairro" value="{{$endereco->bairro}}" label="Bairro" type="text" required="true" readonly="true" placeholder="Ex:. Alto dos Exemplos"  contentClass=""/>
                        <x-form.input name="cep" value="{{$endereco->cep}}" label="CEP" type="text" required="true" readonly="true" placeholder="Ex:. 59215000"  contentClass=""/>
                        <x-form.input name="cidade" value="{{$endereco->cidade}}" label="Cidade" type="text" required="true" readonly="true" placeholder="Cidade"  contentClass=""/>
                        <x-form.input name="estado" value="{{$endereco->estado}}" label="Estado" type="text" required="true" readonly="true" placeholder="Ex:. RN"  contentClass=""/>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
@endsection