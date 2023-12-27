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
                                    <h1 class="h4 text-gray-900 mb-4">Bem vindo!</h1>
                                </div>
                                <x-alert :errors="$errors" :errorCount="$errors->count()" />
                                <form method="post" action="{{route("login.auth")}}" class="user">
                                    @csrf
                                    <div class="form-group">
                                        <input type="email" class="form-control form-control-user {{ $errors->count() > 0 ? "border-danger" : "" }}"
                                            id="exampleInputEmail" name="email" aria-describedby="emailHelp"
                                            placeholder="Digite o seu endereço de email" value="{{old('email')}}" required>
                                    </div>
                                    <div class="form-group">
                                        <input type="password" name="password" class="form-control form-control-user"
                                            id="exampleInputPassword" placeholder="Senha" required>
                                    </div>
                                    <div class="form-group">
                                        <div class="custom-control custom-checkbox small">
                                            <input type="checkbox" class="custom-control-input" id="customCheck">
                                            <label class="custom-control-label" for="customCheck">Lembre de mim</label>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-primary btn-user btn-block">
                                        Login
                                    </button>
                                    <hr>
                                    <a href="{{ $authUrl }}" class="btn btn-google btn-user btn-block">
                                        <i class="fab fa-google fa-fw"></i> Login com Google
                                    </a>
                                    <a href="#" class="btn btn-facebook btn-user btn-block">
                                        <i class="fab fa-facebook-f fa-fw"></i> Login com Facebook
                                    </a>
                                </form>
                                <hr>
                                <div class="text-center">
                                    <a class="small" href="{{ route('password.send_mail') }}">Resetar Senha</a>
                                </div>
                                <div class="text-center">
                                    <a class="small" href="{{route("register")}}">Novo por aqui? Crie uma conta</a>
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
