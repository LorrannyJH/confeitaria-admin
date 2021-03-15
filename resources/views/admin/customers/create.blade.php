@extends('layouts.app')
@section('title', 'Novo Cliente')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.customers.index')}}">Clientes</a></li>
    <li class="breadcrumb-item active">Novo</li>
@endsection

@section('content')
    <form action="{{route('admin.customers.store')}}" method="post">
        @csrf
        @include('admin.customers._partials.form')
        <div class="form-group">
            <button class="btn btn-success ">Cadastrar</button>
        </div>
    </form>
@endsection

@section('js')
    <script src="{{ asset('js/admin/customers/form.js') }}"></script>
@endsection