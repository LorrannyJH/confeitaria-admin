@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Cliente</li>
@endsection

@section('content')

<div class="col-12">
    
    <div class="card-body">
        <form action="{{route('admin.customers.update', $customer->id)}}" method="post">
            @csrf
            @method('PUT')
            @include('admin.customers._partials.form')
            <div class="form-group">
                <button class="btn btn-success ">Atualizar</button>
            </div>
            
        </form>
    </div>
    
</div>


@endsection

@section('js')
    <script>
        $(document).on('blur', '#cep', function() {
            let cep = $(this).val();
            $.ajax({
                url: 'https://viacep.com.br/ws/'+cep+'/json/',
                method: 'GET',
                dataType: 'json',
                success: function(data) {
                    $('#city').val(data.localidade);
                    $('#uf').val(data.uf);
                    $('#district').val(data.bairro);
                    $('#street').val(data.logradouro);
                },
                error: function(err) {
                    console.log(err)
                }
            });
        });
    </script>
@endsection