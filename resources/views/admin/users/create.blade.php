@extends('layouts.app')
@section('title', 'Novo Usuário')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.users.index')}}">Usuários</a></li>
    <li class="breadcrumb-item active">Novo</li>
@endsection

@section('content')
    <form action="{{route('admin.users.store')}}" method="post">
        @csrf
        @include('admin.users._partials.form')
        <div class="form-group">
            <button class="btn btn-success ">Cadastrar</button>
        </div>
    </form>
@endsection