
<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{route("home")}}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">Sumin <sup><i class="fas fa-laugh-wink"></i></sup></div>
    </a>

    <!-- Divider -->
    <hr class="sidebar-divider my-0">

    <!-- Nav Item - Dashboard -->
    <li class="nav-item">
        <a class="nav-link" href="{{route("home")}}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Dashboard</span></a>
    </li>

    <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Empresas
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    @php
        $empresas = Auth::user()->usuarioEmpresas()->get();
    @endphp
    @if ($empresas->isEmpty())
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" >
                <i class="fas fa-sad-tear"></i>
                <span>Nenhuma Empresa vinculada</span></a>
            </a>
        </li>    
    @else
        @foreach ($empresas as $usuario_empresa)
            @php
                $empresa = $usuario_empresa->empresa()->first();
            @endphp
            <li class="nav-item">
                <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo{{$usuario_empresa->id}}"
                    aria-expanded="true" aria-controls="collapseTwo{{$usuario_empresa->id}}">
                    <i class="fas fa-building"></i>
                    <span>{{$empresa->nome}}</span>
                </a>
                <div id="collapseTwo{{$usuario_empresa->id}}" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
                    <div class="bg-white py-2 collapse-inner rounded">
                        @if ($usuario_empresa->status == "Ativo")
                            <h6 class="collapse-header">Geral</h6>
                            <a class="collapse-item" href="{{ route('movimentacao.index', ['empresa' => $empresa->id]) }}">Financeiro</a>
                            <a class="collapse-item" href="#">Documentação</a>
                            @if ($empresa->tipo_empresa == App\Enums\TipoEmpresa::servico->value)
                                <h6 class="collapse-header">Serviço</h6>
                                <a class="collapse-item" href="{{ route('servico.index', ['empresa' => $empresa->id]) }}">Gerenciar Serviços</a>
                            @elseif($empresa->tipo_empresa == App\Enums\TipoEmpresa::comercio->value)
                                <h6 class="collapse-header">Comércio</h6>
                                <a class="collapse-item" href="#">Relatórios de Venda</a>
                                <a class="collapse-item" href="#">Relatórios de Compra</a>
                            @else
                                <h6 class="collapse-header">Serviço</h6>
                                <a class="collapse-item" href="#">Gerenciar Serviços</a>
                                <h6 class="collapse-header">Comércio</h6>
                                <a class="collapse-item" href="#">Relatórios de Venda</a>
                                <a class="collapse-item" href="#">Relatórios de Compra</a>
                            @endif
                        @elseif($usuario_empresa->status == "Pendente")
                            <h6 class="collapse-header">Aguardando confirmação <br> da solicitação!</h6>
                        @elseif($usuario_empresa->status == "Negado")
                            <h6 class="collapse-header">Solicitação Negada pelo Titular!</h6>
                        @elseif($usuario_empresa->status == "Recidido")
                            <h6 class="collapse-header">Vínculo Finalizado!</h6>
                        @endif
                    </div>
                </div>
            </li>
        @endforeach
    @endif

    <hr class="sidebar-divider d-none d-md-block">

    <div class="sidebar-heading">
        Addons
    </div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#">
            <i class="fas fa-envelope"></i>
            <span>Suporte</span>
        </a>
    </li>

    {{-- <!-- Nav Item - Utilities Collapse Menu -->
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
            aria-expanded="true" aria-controls="collapseUtilities">
            <i class="fas fa-fw fa-wrench"></i>
            <span>Utilities</span>
        </a>
        <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Custom Utilities:</h6>
                <a class="collapse-item" href="#">Colors</a>
                <a class="collapse-item" href="#">Borders</a>
                <a class="collapse-item" href="#">Animations</a>
                <a class="collapse-item" href="#">Other</a>
            </div>
        </div>
    </li> --}}

    {{-- <!-- Divider -->
    <hr class="sidebar-divider">

    <!-- Heading -->
    <div class="sidebar-heading">
        Addons
    </div>

    <!-- Nav Item - Pages Collapse Menu -->
    <li class="nav-item active">
        <a class="nav-link" href="#" data-toggle="collapse" data-target="#collapsePages" aria-expanded="true"
            aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Pages</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages"
            data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Login Screens:</h6>
                <a class="collapse-item" href="#">Login</a>
                <a class="collapse-item" href="#">Register</a>
                <a class="collapse-item" href="#">Forgot Password</a>
                <div class="collapse-divider"></div>
                <h6 class="collapse-header">Other Pages:</h6>
                <a class="collapse-item" href="#">404 Page</a>
                <a class="collapse-item active" href="#">Blank Page</a>
            </div>
        </div>
    </li>

    <!-- Nav Item - Charts -->
    <li class="nav-item">
        <a class="nav-link" href="charts.html">
            <i class="fas fa-fw fa-chart-area"></i>
            <span>Charts</span></a>
    </li>

    <!-- Nav Item - Tables -->
    <li class="nav-item">
        <a class="nav-link" href="tables.html">
            <i class="fas fa-fw fa-table"></i>
            <span>Tables</span></a>
    </li> --}}

    <!-- Divider -->
    <hr class="sidebar-divider d-none d-md-block">

    <!-- Sidebar Toggler (Sidebar) -->
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>

</ul>