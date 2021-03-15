@extends('layouts.app')
@section('title', 'Editar Usuário')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.users.index')}}">Usuários</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
    <form action="{{route('admin.users.update', $user->id)}}" method="post">
        @csrf
        @method('PUT')
        @include('admin.users._partials.form')
        <div class="form-group">
            <button class="btn btn-success ">Atualizar</button>
        </div>
    </form>
@endsection