@extends('layouts.default_layout')

@section('title_page')
    <div class="d-flex mb-0">
        <h3 class="h3 text-gray-800">Serviços&nbsp;>></h3>
        <h3 class="h3 text-gray-800">&nbsp;{{ $empresa->nome }}&nbsp;>></h3>
        <h3 class="h3 text-gray-800">Cadastrar Serviço</h3>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4 mx-0 ">
        <!-- Card Header - Accordion -->
        <div class="card-body">
            <x-alert :errors="$errors" :errorCount="$errors->count()" />
            <form method="post" action="{{ route('servico.store', ['empresa' => $empresa->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="orcamento_previo">Orçamento Inicial</label>
                    <input type="text" class="form-control form-control-user"
                        id="orcamento_previo" name="orcamento_previo" placeholder="Orçamento Inicial do Servico - Apenas números" 
                        value="{{ old('orcamento_previo') }}" required>
                </div>
                <div class="form-group">
                    <label for="orcamento_final">Orçamento Final</label>
                    <input type="text" class="form-control form-control-user"
                        id="orcamento_final" name="orcamento_final" placeholder="Orçamento Final do Servico - Apenas números" 
                        value="{{ old('orcamento_final') }}">
                </div>
                <div class="form-group">
                    <label for="descricao">Descrição</label>
                    <textarea type="text" class="form-control form-control-user"
                        id="descricao" name="descricao" placeholder="Descrição do Serviço" 
                        value="{{ old('descricao') }}" 
                        cols="30" rows="10"
                        required>
                    </textarea>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">
                        Cadastrar
                    </button>
    
                    <a href="{{ route('servico.index', ['empresa' => $empresa->id]) }}" class="btn btn-secondary ml-2">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection