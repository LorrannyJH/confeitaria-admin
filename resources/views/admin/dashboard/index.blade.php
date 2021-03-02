@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item active">Dashboard</li>
@endsection

@section('content')
<div class="row">
    <div class="col-12">
    
        <div class="row">
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">Usuários</div>
                    <div class="card-body">
                        <span class="h3">
                        {{ $data['users_count'] }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">Clientes</div>
                    <div class="card-body">
                        <span class="h3">
                        {{ $data['customers_count'] }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">Produtos</div>
                    <div class="card-body">
                        <span class="h3">
                        {{ $data['products_count'] }}
                        </span>
                    </div>
                </div>
            </div>
            <div class="col-12 col-lg-3">
                <div class="card">
                    <div class="card-header bg-primary text-white">Pedidos</div>
                    <div class="card-body">
                        <span class="h3">
                        {{ $data['orders_count'] }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

    </div>
</div>    
@endsection