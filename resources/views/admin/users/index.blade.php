@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Usuário</li>
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
                    <form action="{{route('admin.users.destroy', $user->id)}}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger ml-2">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
    </tbody>
</table>

{{ $data['users']->links() }}

@endsection