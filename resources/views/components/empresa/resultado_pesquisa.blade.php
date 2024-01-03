<div>
    @if ($search != null && $search->pesquisa != "")
        @if ($search->empresas->isEmpty())
            @php
                $possuiEmpresa = App\Services\UsuarioServices::usuarioPossuiEmpresaTitular();
            @endphp
            <hr/>
            <h6 class="m-0 font-weight-bold text-primary">Não foi encontrado uma empresa com o CNPJ: {{ $search->pesquisa }} <br/> {{ !$possuiEmpresa ? "Deseja Cadastrar?" : ""}}</h6>
            @if (!$possuiEmpresa)
                <span class="btn btn-sm btn-primary mt-1" id="show_create_company">
                    Cadastrar Empresa com o CNPJ: {{ $search->pesquisa }} 
                </span>

                <div class="mt-3 d-none" id="cadastrar_empresa">
                    <hr>
                    <form method="post" action="{{route('empresa.store')}}" class="user">
                        @csrf
                        <div class="form-group">
                            <label for="">Nome da Empresa</label>
                            <input type="text" class="form-control" id="nome" name="name" value="{{old('name')}}"
                                placeholder="Nome da empresa" required>
                        </div>
                        <div class="form-group">
                            <label for="">CNPJ</label>
                            <input type="text" class="form-control" id="cnpj_empresa" name="cnpj" value="{{$search->pesquisa}}"
                                placeholder="Informe o cnpj da empresa" required readonly>
                        </div>
                        <div class="form-group">
                            <label for="">Tipo de Empresa</label>
                            <select class="form-control" name="tipo_empresa" id="tipo_empresa" required>
                                <option disabled selected>Selecione o tipo de Empresa</option>
                                @foreach (App\Enums\TipoEmpresa::TiposEmpresa() as $tipoEmpresa)
                                    <option value="{{$tipoEmpresa->value}}">{{$tipoEmpresa->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <button class="btn btn-primary btn-block" type="submit">
                            Cadastrar Empresa
                        </button>
                        <hr>
                    </form>
                </div>
            @else
                <h6 class="m-0 font-weight-bold card border-left-warning py-2 pl-2">
                    Não é possível realizar o cadastro da empresa com o 
                    CNPJ: {{ $search->pesquisa }}. <br>
                    Você já possui uma empresa com vinculo de Titular!
                </h6>
            @endif
        @else
            <hr/>
            <h6 class="m-0 font-weight-bold text-primary">Empresas encontradas com o CNPJ: {{ $search->pesquisa }}</h6>
            <div class="table-responsive mt-3">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Nome</th>
                            <th>Titular</th>
                            <th>CNPJ</th>
                            <th>Ações</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($search->empresas as $key => $empresa)
                            @php
                                $usuario_titular = $empresa->usuarioEmpresa()
                                            ->where('id_tipo_vinculo', 1)->first()
                                            ->usuario()->first();
                            @endphp
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $empresa->nome }}</td>
                                <td>{{ $usuario_titular->getUsualyName() }}
                                </td>
                                <td>{{ $empresa->cnpj }}</td>
                                <td>
                                    @if ($usuario_titular->id != Auth::user()->id)
                                        <a href="{{ route('empresa.solicitar_vinculo', ['empresa' => $empresa->id]) }}" class="btn btn-sm btn-success" title="Solicitar Vinculo">
                                            <i class="fas fa-link"></i>
                                        </a>
                                    @else 
                                        <button class="btn btn-sm btn-primary" title="Gerenciar Empresa">
                                            <i class="fas fa-pen-square"></i>
                                        </button>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        {{-- exibir empresas encontradas --}}
        @endif
    @endif

    <script>
        document.getElementById("show_create_company").addEventListener('click', function(e) {
            const target_div = document.getElementById("cadastrar_empresa");
            target_div.classList.remove("d-none")
        });
    </script>
</div>