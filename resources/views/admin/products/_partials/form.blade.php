<div class="row">
    <div class="form-group col-4">
        <input type="text" placeholder="Produto" class="form-control" name="product[name] " value="{{old('product.name',$product->name ?? '')}}">
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Preço" class="form-control money" name="product[price]" value="{{old('product.price',$product->price ?? '')}}">
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Descrição" class="form-control" name="product[description]" value="{{old('product.description',$product->description ?? '')}}">
    </div>
    <div class="form-group col-4">
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="customFile" name="product[photo]" data-browse="Buscar">
            <label class="custom-file-label" for="customFile" data-browse="Procurar">Selecione</label>
            @if(isset($product) && $product->photo)
                <div class="mt-3">
                    <img width="50px" height="50px" src="{{ url('storage/' . $product->photo) }}">
                    <a download href="{{url('storage/' . $product->photo)}}">Baixar arquivo</a>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group col-4">
        <?php
            $unitTypeValue = old('product.unit_type', $product->unit_type ?? '');
        ?>
        <select class="form-control" name="product[unit_type]" id="unit_type_select">
            <option value="">Selecione o tipo de unidade</option>
            <option <?= $unitTypeValue == 'unit' ? 'selected' : '' ?> value="unit">Unidade</option>
            <option <?= $unitTypeValue == 'kg' ? 'selected' : '' ?> value="kg">Quilo</option>
            <option <?= $unitTypeValue == 'pack' ? 'selected' : '' ?> value="pack">Pacote</option>
        </select>
    </div>
    <div class="form-group col-4 d-none" id="pack_quantity_area">
        <input type="number" placeholder="Quantidade do pacote" class="form-control" name="product[pack_quantity]" value="{{old('product.pack_quantity',$product->pack_quantity ?? '')}}">
    </div>
</div>