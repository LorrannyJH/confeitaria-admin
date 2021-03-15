@extends('layouts.app')
@section('title', 'Editar Pedido')

@section('breadcrumb')
    <li class="breadcrumb-item "><a href="{{route('admin.dashboard.index')}}">Dashboard</a></li>
    <li class="breadcrumb-item active"><a href="{{route('admin.orders.index')}}">Pedidos</a></li>
    <li class="breadcrumb-item active">Editar</li>
@endsection

@section('content')
    
    <form action="{{route('admin.orders.update', $data['order']->id)}}" method="post">
        @csrf
        @method('PUT')
        @include('admin.orders._partials.form')
        <div class="form-group">
            <button class="btn btn-success">Atualizar</button>
        </div> 
    </form>

@endsection

@section('js')
<script src="{{ asset('js/admin/orders/form.js') }}"></script>
<!-- <script>
    var productIndex = $('#products-table .content tr').length

    function addProduct() {
        let selectedProduct = $('#product-select option:selected')
        
        let content=
            '<tr id="product_'+selectedProduct.val()+'">'+
                '<input type="hidden" name="order[product]['+productIndex+'][id]" value="'+selectedProduct.val()+'">'+
                '<td><img width="50px" height="50px" src="'+selectedProduct.data('photo')+'"></td>'+
                '<td>'+selectedProduct.text()+'</td>'+
                '<td width="20px"><input type="number" name="order[product]['+productIndex+'][quantity]" class="form-control"></td>'+
                '<td>R$ '+selectedProduct.data('price')+'</td>'+
                '<td><button type="button" class="btn btn-danger del-product-btn" data-id="product_'+selectedProduct.val()+'">Deletar</button></td>'+
            '</tr>'

        $('#products-table .content').append(content);

        productIndex++;

        $('#add-product-modal').modal('hide');

    }

    function deleteProduct(productId)
    {
        $('#' + productId).remove();
    }

    $(document).on('click', '#add-product-btn', function(){
        addProduct()
    });

    $(document).on('click', '.del-product-btn', function(){
        let productLineId = $(this).data('id');
        deleteProduct(productLineId);
    });
</script> -->
@endsection