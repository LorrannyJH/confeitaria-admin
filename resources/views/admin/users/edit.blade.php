@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Usuário</li>
@endsection

@section('content')

<div class="col-12">
    
    <div class="card-body">
        <form action="{{route('admin.users.update', $user->id)}}" method="post">
            @csrf
            @method('PUT')
            @include('admin.users._partials.form')
            <div class="form-group">
                <button class="btn btn-success ">Atualizar</button>
            </div>
            
        </form>
    </div>
    
</div>


@endsection