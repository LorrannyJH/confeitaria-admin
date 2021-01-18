<div class="row">
    <div class="form-group col-4">
        <input type="text" placeholder="Produto" class="form-control" name="product[name] " value="{{old('product.name',$product->name ?? '')}}">
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Preço" class="form-control" name="product[price]" value="{{old('product.price',$product->price ?? '')}}">
    </div>
    <div class="form-group col-4">
        <input type="text" placeholder="Descrição" class="form-control" name="product[description]" value="{{old('product.description',$product->description ?? '')}}">
    </div>
    <div class="form-group col-4">
        <div class="custom-file mb-3">
            <input type="file" class="custom-file-input" id="customFile" name="product[photo]" data-browse="Buscar">
            <label class="custom-file-label" for="customFile">Selecione</label>
            @if(isset($product) && $product->photo)
                <div class="mt-3">
                    <img width="50px" height="50px" src="{{ url('storage/' . $product->photo) }}">
                    <a download href="{{url('storage/' . $product->photo)}}">Baixar arquivo</a>
                </div>
            @endif
        </div>
    </div>
    <div class="form-group col-4">
        <div class="custom-control custom-checkbox">
            <input {{ isset($product) && $product->price_by_weight ? 'checked' : '' }} type="checkbox" class="custom-control-input" id="price_by_weight" value="1" name="product[price_by_weight]">
            <label class="custom-control-label" for="price_by_weight">Preço por peso</label>
        </div>
    </div>
</div>