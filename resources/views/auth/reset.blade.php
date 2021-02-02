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
    <h5 class="text-center mb-3">Resetar senha</h5>
    <div class="card shadow auth-card">
        <div class="card-body">
            <form method="POST" action="{{route('auth.reset')}}">
                @csrf

                <input type="hidden" name="reset_password_token" value="{{ $data['reset_password_token'] }}">

                <div class="form-group">
                    <input type="password" placeholder="senha" class="form-control" name="password">
                </div>
                <div class="form-group">
                    <input type="password" placeholder="Confirmar senha" class="form-control" name="password_confirmation">
                </div>
                <div>
                    <button class="btn btn-success btn-block">Confirmar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
