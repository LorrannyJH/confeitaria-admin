var productIndex = $('#products-table .content tr').length

function addProduct() {
    let selectedProduct = $('#product-select option:selected')

    let kgField = '<td width="20px">N/A</td>';

    if (selectedProduct.data('unit-type') == 'kg') {
        kgField = 
            '<td width="100px"><input type="text" name="order[product]['+productIndex+'][kg]" class="form-control kg"></td>';
    }

    let imageField = '<td><small>Sem imagem</small></td>';

    if (selectedProduct.data('photo')) {
        imageField = '<td><img width="50px" height="50px" src="'+selectedProduct.data('photo')+'"></td>';
    }
    
    let content=
        '<tr id="product_'+selectedProduct.val()+'">'+
            '<input type="hidden" name="order[product]['+productIndex+'][id]" value="'+selectedProduct.val()+'">'+
            imageField+
            '<td>'+selectedProduct.text()+'</td>'+
            '<td width="20px"><input type="number" name="order[product]['+productIndex+'][quantity]" class="form-control"></td>'+
            kgField+
            '<td>R$ '+selectedProduct.data('price')+'</td>'+
            '<td><button type="button" class="btn btn-danger del-product-btn" data-id="product_'+selectedProduct.val()+'">Deletar</button></td>'+
        '</tr>'

    $('#products-table .content').append(content);

    $('.kg').mask("#.##", {reverse: true});

    productIndex++;

    $('#add-product-modal').modal('hide');

}

function deleteProduct(productId){
    $('#' + productId).remove();
}

$(document).on('click', '#add-product-btn', function(){
    addProduct()
});

$(document).on('click', '.del-product-btn', function(){
    let productLineId = $(this).data('id');
    deleteProduct(productLineId);
});