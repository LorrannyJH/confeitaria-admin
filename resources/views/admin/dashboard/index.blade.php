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

<div class="row mt-4">
    <div class="col-12">
        <h6>Pedidos de hoje:</h6>

        <form method="GET">
            <div class="row align-items-end mb-3">
                <div class="col-2">
                    <div class="form-group mb-0">
                        <label for="">Hora</label>
                            <input type="text" placeholder="Hora" class="form-control hour" name="filter[delivery_hour]" value="{{ $data['orders_today_filtered_delivery_hour'] }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group mb-0">
                        <label for="">Status</label>
                        <select class="form-control" name="filter[status_id]">
                            <option value="all">Todos</option>
                            @foreach($data['status'] as $status)
                                <option {{$data['orders_today_filtered_status_id'] && $data['orders_today_filtered_status_id'] == $status->id ? 'selected' : ''}} value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>

        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Cliente</th>
                    <th>Data de entrega</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th colspan="100%">Ações</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data['orders_today'] as $order)
                    <tr>
                        <td> {{ $order->id }} </td>
                        <td> {{ $order->customer->name }}  </td>
                        <td> {{ $order->delivery_date }} </td>
                        <td>
                            <div class="badge badge-{{ $order->status->getStyle() }} text-white">
                                {{ $order->status->name }}
                            </div>
                        </td>
                        <td> R$ {{ $order->getTotalFormatted() }} </td>
                        <td class="d-flex">
                            <a
                                class="btn btn-primary"
                                href="{{route('admin.orders.edit', $order->id)}}"
                            >
                                Ver/Editar
                            </a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $data['orders_today']->links() }}
    </div>
</div>    
@endsection