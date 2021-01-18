@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Usuário</li>
@endsection

@section('content')

<div class="col-12">
    
    <div class="card-body">
        <form action="{{route('admin.users.store')}}" method="post">
            @csrf
            @include('admin.users._partials.form')
            <div class="form-group">
                <button class="btn btn-success ">Cadastrar</button>
            </div>
            
        </form>
    </div>
    
</div>


@endsection