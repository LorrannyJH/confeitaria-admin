@extends('layouts.app')
@section('title', 'Dashboard')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active">Pedido</li>
@endsection

@section('content')

<div class="col-12">
    
    <div class="card-body">
        <form action="{{route('admin.orders.store')}}" method="post">
            @csrf
            @include('admin.orders._partials.form')
            <div class="form-group">
                <button class="btn btn-success ">Cadastrar</button>
            </div>
            
        </form>
    </div>
    
</div>


@endsection

@section('js')
<script>
    function addProduct() {
        let selectedProduct = $('#product-select option:selected')
        
        let content=
            '<tr>'+
                '<input type="hidden" value="'+selectedProduct.val()+'">'+
                '<td>'+selectedProduct.text()+'</td>'+
                '<td><input type="number" class="form-control"></td>'+
                '<td>'+selectedProduct.data('price')+'</td>'+
            '</tr>'

        $('#products-table .content').append(content);

        $('#add-product-modal').modal('hide');

    }

    $(document).on('click', '#add-product-btn', function(){
        addProduct()
    })
</script>
@endsection