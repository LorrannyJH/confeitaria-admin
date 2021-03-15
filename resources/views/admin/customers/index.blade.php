@extends('layouts.app')
@section('title', 'Clientes')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Clientes</li>
@endsection

@section('content')
<div class="row mb-3 text-right" >
    <div class="col-12 ">

        <a
            class="btn btn-success"
            href="{{route('admin.customers.create')}}"
        >
            Novo Cliente
        </a>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nome</th>
            <th>Telefone</th>
            <th>Endereço</th>
            <th colspan="100%">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['customers'] as $customer)
            <tr>
                <td> {{ $customer->name }}  </td>
                <td> {{ $customer->phone }} </td>
                @if($customer->address)
                    <td> {{ $customer->address->street }} - Nº {{ $customer->address->number }} </td>
                @else
                    <td><small>Sem Endereço</small></td>
                @endif
                
                <td class="d-flex">
                    <a
                        class="btn btn-warning"
                        href="{{route('admin.customers.edit', $customer->id)}}"
                    >
                        Editar
                    </a>
                    <form action="{{route('admin.customers.destroy', $customer->id)}}" method="POST" class="delete-form">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ml-2">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $data['customers']->links() }}
@endsection

@section('js')
    <script>
        $('.delete-form').on('submit', function(event) {
            event.preventDefault();

            let form = $(this);

            Swal.fire({
                title: 'Tem certeza que deseja excluir este usuário?',
                text: "Esta ação não poderá ser revertida!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Deletar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.unbind('submit');
                    form.submit();
                }
            });
        });
    </script>
@endsection