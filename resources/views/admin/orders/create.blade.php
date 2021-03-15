@extends('layouts.app')
@section('title', 'Novo Pedido')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.orders.index')}}">Pedidos</a></li>
    <li class="breadcrumb-item active">Novo</li>
@endsection

@section('content')

    <form action="{{route('admin.orders.store')}}" method="post">
        @csrf
        @include('admin.orders._partials.form')
        <div class="form-group">
            <button class="btn btn-success">Cadastrar</button>
        </div> 
    </form>

@endsection

@section('js')
<script src="{{ asset('js/admin/orders/form.js') }}"></script>
@endsection