function findAddressByCep() {
    let cep = $('#cep').val();
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
}

$(function() {
    findAddressByCep();
});

$(document).on('blur', '#cep', function() {
    findAddressByCep();
});