@extends('layouts.app')
@section('title', 'Pedidos')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pedidos</li>
@endsection

@section('content')
<div class="row mb-3">
    <div class="col-6">
        <form method="GET">
            <div class="row align-items-end mb-3">
                <div class="col-3">
                    <div class="form-group mb-0">
                        <label for="">Data</label>
                        <input type="text" placeholder="Data" class="form-control date" name="filter[delivery_date]" value="{{ $data['filtered_delivery_date'] }}">
                    </div>
                </div>
                <div class="col-2">
                    <div class="form-group mb-0">
                        <label for="">Hora</label>
                            <input type="text" placeholder="Hora" class="form-control hour" name="filter[delivery_hour]" value="{{ $data['filtered_delivery_hour'] }}">
                    </div>
                </div>
                <div class="col-3">
                    <div class="form-group mb-0">
                        <label for="">Status</label>
                        <select class="form-control" name="filter[status_id]">
                            <option value="all">Todos</option>
                            @foreach($data['status'] as $status)
                                <option {{$data['filtered_status_id'] && $data['filtered_status_id'] == $status->id ? 'selected' : ''}} value="{{$status->id}}">{{$status->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-3">
                    <button type="submit" class="btn btn-primary">Filtrar</button>
                </div>
            </div>
        </form>
    </div>
    <div class="col-6 text-right">
        <a
            class="btn btn-success"
            href="{{route('admin.orders.create')}}"
        >
            Novo Pedido
        </a>
    </div>
</div>

<div class="row">
    <div class="col-12">
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
                @foreach($data['orders'] as $order)
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
        {{ $data['orders']->links() }}
    </div>
</div>

@endsection