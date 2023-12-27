@extends('layouts.default_layout')

@section('title_page')
    <div class="d-flex mb-0">
        <h3 class="h3 text-gray-800">Gerenciar Empresa&nbsp;>></h3>
        <a href="{{ route('empresa.index', ['empresa' => $empresa->id]) }}">
            <h3 class="h3 text-gray-800">&nbsp;{{ $empresa->nome }}&nbsp;>></h3>
        </a>
        <h3 class="h3 text-gray-800">&nbsp;Cadastrar Contato</h3>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4 p-3">
        <x-alert :errors="$errors" :errorCount="$errors->count()" />
        <form method="post" action="{{ route('empresa.store_contato', ['empresa' => $empresa->id]) }}">
            @csrf
            <div class="d-flex justify-content-between flex-lg-row flex-md-column">
                <x-form.input name="telefone" label="Telefone" type="text" value="" required="false" readonly="false"  placeholder="Telefone" contentClass="col-lg-6 col-md-12 pl-0 pr-lg-2 pr-md-0" />
                <x-form.input name="email" label="Email" type="email" value="" required="false" readonly="false" placeholder="exemplo@exemplo.com" contentClass="col-lg-6 col-md-12 pr-0 pl-lg-2 pl-md-0" />
            </div>
            <div class="d-flex justify-content-between flex-lg-row flex-md-column">
                <x-form.input name="celular" label="Celular" type="text" value="" required="true" readonly="false" placeholder="849XXXXXXXX"  contentClass="col-lg-6 col-md-12 pl-0 pr-lg-2 pr-md-0"/>
                <x-form.input name="whatsapp" label="Whatsapp" type="text" value="" required="false" readonly="false" placeholder="+55849XXXXXXXX " contentClass="col-lg-6 col-md-12 pr-0 pl-lg-2 pl-md-0" />
            </div>
            <div class="d-flex justify-content-between flex-lg-row flex-md-column">
                <x-form.input name="facebook" label="Facebook" type="text" value="" required="false" readonly="false" placeholder="Facebook" contentClass="col-lg-6 col-md-12 pl-0 pr-lg-2 pr-md-0" />
                <x-form.input name="instagram" label="Instagram" type="text" value="" required="false" readonly="false" placeholder="Instagram" contentClass="col-lg-6 col-md-12 pr-0 pl-lg-2 pl-md-0" />
            </div>
            <x-form.input name="linkedin" label="Linkedin" type="text" value="" required="false" readonly="false" placeholder="linkedin" contentClass="" />

            <div class="d-flex justify-content-end">
                <button class="btn btn-primary" type="submit">
                    Cadastrar
                </button>

                <a href="{{ route('empresa.index', ['empresa' => $empresa->id]) }}" class="btn btn-secondary ml-2">
                    Cancelar
                </a>
            </div>
        </form>
    </div>
@endsection