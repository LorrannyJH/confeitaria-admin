<div class="row align-items-end">
    <div class="form-group col-2">
        <label for="">Data de entrega</label>
        <input type="text" placeholder="Data de entrega" class="form-control date" name="order[delivery_date]" 
        value="{{explode(' ', old('order.delivery_date',$data['order']->delivery_date ?? ''))[0] ?? ''}}" >
    </div>
    <div class="form-group col-2">
        <label for="">Hora de entrega</label>
        <input type="text" placeholder="Hora de entrega" class="form-control hour" name="order[delivery_hour]"
        value="{{explode(' ', old('order.delivery_hour',$data['order']->delivery_date ?? ''))[1] ?? ''}}" >
    </div>
    <div class="form-group col-3">
        <label for="">Cliente</label>
        <select class="form-control" name="order[customer_id]">
            @foreach($data['customers'] as $customer)
                <option {{$data['order'] && $data['order']->customer_id == $customer->id ? 'selected' : ''}} value="{{$customer->id}}">{{$customer->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-3">
        <label for="">Status</label>
        <select class="form-control" name="order[status_id]">
            @foreach($data['status'] as $status)
                <option {{$data['order'] && $data['order']->status_id == $status->id ? 'selected' : ''}} value="{{$status->id}}">{{$status->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group col-2">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#add-product-modal">
        Novo Produto
      </button>
    </div>
</div>

<div class="row">
    <div class="col-12">

        <table class="table" id="products-table">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Kg</th>
                    <th>Valor</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody class="content">
              @if($data['order'])
                @foreach($data['order']->orderProducts as $key => $orderProduct)
                  <tr id="product_{{ $orderProduct->product->id }}">
                      <input type="hidden" name="order[product][{{ $key }}][id]" value="{{ $orderProduct->product->id }}">
                      <td>
                        @if($orderProduct->product->photo)
                          <img width="50px" height="50px" src="{{ asset('storage/' . $orderProduct->product->photo) }}">
                        @else
                          <small>Sem Imagem</small>
                        @endif
                      </td>
                      <td>{{ $orderProduct->product->name }}</td>
                      <td width="20px"><input type="number" value="{{ $orderProduct->quantity }}" name="order[product][{{ $key }}][quantity]" class="form-control"></td>
                      <td width="100px">
                        @if($orderProduct->product->unit_type == 'kg')
                          <input type="text" name="order[product][{{ $key }}][kg]" class="form-control kg" value="{{ $orderProduct->kg }}">
                        @else
                          N/A
                        @endif
                      </td>
                      <td>R$ {{ $orderProduct->getPriceFormatted() }}</td>
                      <td><button type="button" class="btn btn-danger del-product-btn" data-id="product_{{ $orderProduct->product->id }}">Deletar</button></td>
                  </tr>
                @endforeach
              @endif
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
                      data-price="{{$product->price_formatted}}"
                      data-unit-type="{{$product->unit_type}}"
                      data-photo="{{$product->photo ? asset('storage/' . $product->photo) : false}}"
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

