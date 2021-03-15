@extends('layouts.app')
@section('title', 'Usuários')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Usuários</li>
@endsection

@section('content')
<div class="row mb-3 text-right" >
    <div class="col-12 ">

        <a
            class="btn btn-success"
            href="{{route('admin.users.create')}}"
        >
            Novo Usuário
        </a>
    </div>
</div>

<table class="table table-hover">
    <thead>
        <tr>
            <th>Nome</th>
            <th>E-mail</th>
            <th>Papel</th>
            <th colspan="100%">Ações</th>
        </tr>
    </thead>
    <tbody>
        @foreach($data['users'] as $user)
            <tr>
                <td> {{ $user->name }}  </td>
                <td> {{ $user->email }} </td>
                <td> {{ $user->role->name }} </td>
                
                <td class="d-flex">
                    <a
                        class="btn btn-warning"
                        href="{{route('admin.users.edit', $user->id)}}"
                    >
                        Editar
                    </a>
                    @if($user->id != auth()->user()->id)
                        <form action="{{route('admin.users.destroy', $user->id)}}" method="POST" class="delete-form">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger ml-2">Deletar</button>
                        </form>
                    @endif
                </td>
            </tr>
        @endforeach
    </tbody>
</table>
{{ $data['users']->links() }}
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