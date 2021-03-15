@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Produto</li>
@endsection

@section('content')

<div class="col-12">
    <form action="{{ route('admin.products.import') }}" method="POST" enctype="multipart/form-data">

        @csrf

        <div class="card">
            <div class="card-header bg-dark text-white">
                Importar arquivo CSV
            </div>
            <div class="card-body">
                <div class="col-12">
                    <div class="form-group">
                        <input name="file" type="file" class="custom-file-input" id="file-input">
                        <label class="custom-file-label" for="file-input" data-browse="Procurar">
                            Procurar
                        </label>
                    </div>
                </div>
            </div>
            <div class="card-footer text-right">
                <button type="submit" class="btn btn-success">Importar</button>
            </div>

        </div> 
    </form>
</div>

<div class="col-12 mt-4">
    <div class="card">  
        <div class="card-body">
            <form action="{{route('admin.products.store')}}" method="post" enctype="multipart/form-data">
                @csrf
                @include('admin.products._partials.form')
                <div class="form-group">
                    <button class="btn btn-success ">Cadastrar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script src="{{ asset('js/admin/products/form.js') }}"></script>
@endsection