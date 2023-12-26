@extends('layouts.default_layout')

@section('title_page', "Vincular Empresa")

@section('content')
    <div class="card shadow mb-4 p-3">
        <x-alert :errors="$errors" :errorCount="$errors->count()" />
        <form method="post" action="{{ route('empresa.create') }}">
            @csrf
            <div class="input-group">
                <input type="text" class="form-control bg-light border-0 small" placeholder="Digite o CNPJ da empresa ex: 00.000.000/0001-00"
                    aria-label="Search" aria-describedby="basic-addon2" id="cnpj" name="cnpj" value="{{$search->pesquisa ?? ""}}">
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit">
                        <i class="fas fa-search fa-sm"></i>
                    </button>
                </div>
            </div>
        </form>

        <div class="{{ isset($search) ? "" : "d-none" }}">
            <x-empresa.resultado_pesquisa :search="$search ?? null" />
        </div>
    </div>
@endsection