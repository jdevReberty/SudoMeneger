@extends('layouts.login_layout')

@section('title', 'Login')

@section('content')
  <div class="container">
    <!-- Outer Row -->
    <div class="row justify-content-center">
        <div class="col-xl-10 col-lg-12 col-md-9">
            <div class="card o-hidden border-0 shadow-lg my-5">
                <div class="card-body p-0">
                    <!-- Nested Row within Card Body -->
                    <div class="row">
                        <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                        <div class="col-lg-6">
                            <div class="p-5">
                                <div class="text-center">
                                    <h1 class="h4 text-gray-900 mb-4">Crie sua conta!</h1>
                                </div>
                                <x-alert :errors="$errors" :errorCount="$errors->count()" />
                                <form method="post" action="{{route("register.store")}}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="text" class="form-control form-control-user" id="nome" name="name" value="{{old('name')}}"
                                            placeholder="Nome" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user" id="email" name="email" value="{{old('email')}}"
                                            placeholder="Email Address" required>
                                    </div>
                                    <div class="form-group row">
                                        <div class="col-sm-6 mb-3 mb-sm-0">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleInputPassword" placeholder="Senha" name="password" required />
                                        </div>
                                        <div class="col-sm-6">
                                            <input type="password" class="form-control form-control-user"
                                                id="exampleRepeatPassword" placeholder="Confirmar Senha" name="confirm_password" required />
                                        </div>
                                    </div>
                                    <button class="btn btn-primary btn-user btn-block">
                                        Criar Conta
                                    </button>
                                    <hr>
                                    <a href="{{ $authUrl }}" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Criar com o google
                                    </a>
                                    {{-- <a href="#" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Criar com o Facebook
                                    </a> --}}
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{route('login')}}">Já tem uma conta? Faça Login</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
@endsection

@section('script') 
  <script>
    document.querySelector(".form-control").addEventListener("click", function(event) {
      event.target.classList.remove("border-danger");
    });
  </script>

@endsection
