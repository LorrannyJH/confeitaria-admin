<div class="row">
    <div class="form-group col-4">
        <input type="text" placeholder="Data de entrega" class="form-control" name="order[delivery_date]" value="{{old('order.delivery_date',$order->delivery_date ?? '')}}" >
    </div>
    <div class="form-group col-4">
        <select class="form-control" name="order[customer_id]">
            @foreach($data['customers'] as $customer)
                <option {{isset($order) && $order->customer_id == $customer->id ? 'selected' : ''}} value="{{$customer->id}}">{{$customer->name}}</option>
            @endforeach
        </select>
    </div>
</div>
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-product-modal">
  Novo Produto
</button>
<div class="row">
    <div class="col-12">

        <table class="table" id="products-table">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                </tr>
            </thead>
            <tbody class="content">
            
            </tbody>
        </table>

    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="add-product-modal" tabindex="-1" aria-labelledby="add-product-modalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="add-product-modalLabel">Novo Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <div class="row">
          <div class="form-group col-12">
            <select class="form-control" id="product-select" name="order[product_id]">
                @foreach($data['products'] as $product)
                    <option
                      value="{{$product->id}}"
                      data-price="{{$product->price}}"
                    >
                      {{$product->name}}
                    </option>
                @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="button" id="add-product-btn" class="btn btn-primary">Adicionar</button>
      </div>
    </div>
  </div>
</div>

