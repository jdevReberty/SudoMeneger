@extends('layouts.default_layout')

@section('title_page')
    <div class="d-flex mb-0">
        <h3 class="h3 text-gray-800">Financeiro&nbsp;>></h3>
        <h3 class="h3 text-gray-800">&nbsp;{{ $empresa->nome }}&nbsp;>></h3>
        <h3 class="h3 text-gray-800">Cadastrar movimentação</h3>
    </div>
@endsection

@section('content')
    <div class="card shadow mb-4 mx-0 ">
        <!-- Card Header - Accordion -->
        <div class="card-body">
            <x-alert :errors="$errors" :errorCount="$errors->count()" />
            <form method="post" action="{{ route('movimentacao.store_movimentacao_comercio', ['empresa' => $empresa->id]) }}">
                @csrf
                <div class="form-group">
                    <label for="">Tipo de Movimentação</label>
                    <select class="form-control" name="id_tipo_movimentacao" id="id_tipo_movimentacao" required>
                        <option selected disabled>Selecione o tipo de movimentação</option>
                        @foreach (App\Enums\TipoMovimentacao::TiposMovimentacao() as $case)
                            @if ($case->value != 1)
                                <option value="{{$case->value}}">{{$case->name}}</option>
                            @endif
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="valor">Valor</label>
                    <input type="text" class="form-control form-control-user"
                        id="valor" name="valor" placeholder="Apenas números" 
                        value="{{ old('valor') }}" required>
                </div>
                <div class="d-flex justify-content-end">
                    <button class="btn btn-primary" type="submit">
                        Cadastrar
                    </button>
    
                    <a href="{{ route('movimentacao.index', ['empresa' => $empresa->id]) }}" class="btn btn-secondary ml-2">
                        Cancelar
                    </a>
                </div>
            </form>
        </div>
    </div>
@endsection