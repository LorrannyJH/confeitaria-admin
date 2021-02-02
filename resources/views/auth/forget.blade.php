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
    <h5 class="text-center mb-3">Recuperar Senha</h5>
    <div class="card shadow auth-card">
        <div class="card-body">
            <form method="POST" action="{{route('auth.send-recover-link')}}">
                @csrf
                <div class="form-group">
                    <input type="email" placeholder="email" class="form-control" name="email">
                </div>
                
                <div>
                    <button class="btn btn-success btn-block">Enviar link</button>
                </div>
            </form>
        </div>
    </div>
</div>

@stop
