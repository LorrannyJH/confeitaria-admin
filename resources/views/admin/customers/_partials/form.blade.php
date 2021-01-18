<div class="row">
    <div class="form-group col-4">
        <input type="text" placeholder="usuário" class="form-control" name="customer[name]" value="{{old('customer.name',$customer->name ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Telefone" class="form-control" name="customer[phone]" value="{{old('customer.phone',$customer->phone ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="CEP" class="form-control" name="address[cep]" id = "cep" value="{{old('customer.name',$customer->name ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Rua" class="form-control" name="address[street]" id = "street" value="{{old('address.street',$customer->address->street ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Número" class="form-control" name="address[number]" value="{{old('address.number',$customer->address->number ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Bairro" class="form-control" name="address[district]" id = "district" value="{{old('address.district',$customer->address->district ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Cidade" class="form-control" name="address[city]" id = "city" value="{{old('address.city',$customer->address->city ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="UF" class="form-control" name="address[uf]" id = "uf" value="{{old('address.uf',$customer->address->uf ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Complemento" class="form-control" name="address[complement]" value="{{old('address.complement',$customer->address->complement ?? '')}}" >
    </div>
</div>