@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Produtos</li>
@endsection

@section('content')
<div class="row mb-3 text-right" >
    <div class="col-12">
        <a
            class="btn btn-primary"
            href="{{route('admin.products.export')}}"
        >
            Exportar produtos
        </a>
        <a
            class="btn btn-success"
            href="{{route('admin.products.create')}}"
        >
            Novo Produto
        </a>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>#</th>
            <th>Nome</th>
            <th>Preço</th>
            <th colspan="100%">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['products'] as $product)
            <tr>
                <td> <img width="50px" height="50px" src="storage/{{ $product->photo }}"> </td>
                <td> {{ $product->name }}  </td>
                <td> {{ $product->price }} </td> 
                <td class="d-flex">
                    <a
                        class="btn btn-warning"
                        href="{{route('admin.products.edit', $product->id)}}"
                    >
                        Editar
                    </a>
                    <form action="{{route('admin.products.destroy', $product->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ml-2">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $data['products']->links() }}


@endsection