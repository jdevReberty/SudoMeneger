@extends('layouts.default_layout')

@section('title_page')
    <div class="d-flex mb-0">
        <a href="{{ route('usuario.index', ['usuario' => $usuario->id]) }}">
            <h3 class="h3 text-gray-800">&nbsp;{{ $usuario->name }}&nbsp;>></h3>
        </a>
        <h3 class="h3 text-gray-800">&nbsp;Cadastrar Endereço</h3>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4 p-3">
        <x-alert :errors="$errors" :errorCount="$errors->count()" />
        <form method="post" action="{{ route('usuario.store_endereco', ['usuario' => $usuario->id]) }}">
            @csrf
            <div class="d-flex justify-content-between flex-lg-row flex-md-column">
                <x-form.input name="logradouro" label="Logradouro" type="text" value="" required="true" readonly="false"  placeholder="Ex:. Rua exemplo" contentClass="col-lg-6 col-md-12 pl-0 pr-lg-2 pr-md-0" />
                <x-form.input name="numero" label="Número" type="text" value="" required="true" readonly="false" placeholder="Ex:. 02" contentClass="col-lg-6 col-md-12 pr-0 pl-lg-2 pl-md-0" />
            </div>
            <div class="d-flex justify-content-between flex-lg-row flex-md-column">
                <x-form.input name="bairro" label="Bairro" type="text" value="" required="true" readonly="false" placeholder="Ex:. Alto dos Exemplos"  contentClass="col-lg-6 col-md-12 pl-0 pr-lg-2 pr-md-0"/>
                <x-form.input name="cep" label="Cep" type="text" value="" required="true" readonly="false" placeholder="Ex:. 59215000" contentClass="col-lg-6 col-md-12 pr-0 pl-lg-2 pl-md-0" />
            </div>
            <div class="d-flex justify-content-between flex-lg-row flex-md-column">
                <x-form.input name="cidade" label="Cidade" type="text" value="" required="true" readonly="false" placeholder="Cidade" contentClass="col-lg-6 col-md-12 pl-0 pr-lg-2 pr-md-0" />
                <x-form.input name="estado" label="Estado" type="text" value="" required="true" readonly="false" placeholder="Ex:. RN" contentClass="col-lg-6 col-md-12 pr-0 pl-lg-2 pl-md-0" />
            </div>

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">
                    Cadastrar
                </button>

                <a href="{{ route('usuario.index', ['usuario' => $usuario->id]) }}" class="btn btn-secondary ml-2">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection