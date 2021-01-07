@extends('layouts.auth')
@section('css')
<style>
    .auth-card {
        width: 350px;
        height: auto;
    }
</style>
@stop
@section('content')

<div class="mx-auto">
    <h5 class="text-center mb-3">Login</h5>
    <div class="card shadow auth-card">
        <div class="card-body">
            <form method="POST" action="{{route('auth.login.login')}}">
                @csrf
                <div class="form-group">
                    <input type="email" placeholder="email" class="form-control" name="email">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="senha" class="form-control" name="password">
                </div>
                <div>
                    <button class="btn btn-success btn-block">Entrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
