function showOrHidePackQuantityArea() {
    if ($('#unit_type_select').val() == 'pack') {
        $('#pack_quantity_area').removeClass('d-none')
    } else {
        $('#pack_quantity_area').addClass('d-none')
    }
}

$(function() {
    showOrHidePackQuantityArea()
});

$(document).on('change', '#unit_type_select', function() {
    showOrHidePackQuantityArea();
});