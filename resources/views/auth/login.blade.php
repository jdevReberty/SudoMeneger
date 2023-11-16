@extends('layouts.login_layout')

@section('title', 'Login')

@section('content')
<div class="">
    <form class="form-control" action="{{route('login.auth')}}" method="post">
        @csrf
        <div class="mb-3">
          <label for="email" class="form-label">E-mail</label>
          <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp" required>
          <div id="emailHelp" class="form-text">Nunca compartilhe seu e-mail com terceiros.</div>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Senha</label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-primary">Entrar</button>
    </form>
</div>
@endsection