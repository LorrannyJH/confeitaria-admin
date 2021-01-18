@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Produto</li>
@endsection

@section('content')

<div class="col-12">
    
    <div class="card-body">
        <form action="{{route('admin.products.update', $product->id)}}" method="post" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            @include('admin.products._partials.form')
            <div class="form-group mt-3">
                <button class="btn btn-success ">Atualizar</button>
            </div>
            
        </form>
    </div>
    
</div>


@endsection