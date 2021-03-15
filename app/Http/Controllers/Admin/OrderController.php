<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\Admin\OrderRequest;
use App\{Order, OrderProduct, Customer, Product, Status};
use Carbon\Carbon;

class OrderController extends Controller
{
    public function index(Request $request)
    {
        $orders = new Order;

        if ($request['filter'] && $request['filter']['status_id'] && $request['filter']['status_id'] != 'all'){
            $orders = $orders->where('status_id', $request['filter']['status_id']);
        }

        if ($request['filter'] && $request['filter']['delivery_date'] && $request['filter']['delivery_date'] != ''){
            $deliveryDateFormatted = Carbon::createFromFormat('d/m/Y', $request['filter']['delivery_date']);
            $orders = $orders->whereDate('delivery_date', $deliveryDateFormatted);
        }

        if ($request['filter'] && $request['filter']['delivery_hour'] && $request['filter']['delivery_hour'] != ''){
            $orders = $orders->whereRaw('HOUR(delivery_date) = ?', [$request['filter']['delivery_hour'] . ':00']);
        }

        $orders = $orders
            ->orderBy('delivery_date', 'DESC')
            ->paginate(5);

        $data = [
            'orders' => $orders,
            'status' => Status::all(),
            'filtered_status_id' => $request['filter']['status_id'] ?? null,
            'filtered_delivery_date' => $request['filter']['delivery_date'] ?? null,
            'filtered_delivery_hour' => $request['filter']['delivery_hour'] ?? null,
        ];

        return view('admin.orders.index', compact('data'));
    }

    public function create()
    {
        $data = [
            'customers' => Customer::select('id', 'name')->get(),
            'products' => Product::all(),
            'status' => Status::all(),
            'order' => ''
        ];

        return view('admin.orders.create', compact('data'));
    }

    public function store(OrderRequest $request)
    {
        $deliveryDate = $request->order['delivery_date'] . ' ' . $request->order['delivery_hour'];

        $order = Order::create([
            'delivery_date' => $deliveryDate,
            'customer_id' => $request->order['customer_id'],
            'status_id' => $request->order['status_id'],
        ]);

        foreach ($request->order['product'] as $productRequestData) {
            $product = Product::findOrFail($productRequestData['id']);

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $productRequestData['quantity'],
                'price' => $product->price,
                'kg' => $productRequestData['kg'] ?? null
            ]);
        }

        return redirect()
            ->route('admin.orders.index')
            ->with('msg_success', 'Pedido criado com sucesso!');
    }

    public function edit(Order $order)
    {
        $data = [
            'customers' => Customer::select('id', 'name')->get(),
            'products' => Product::all(),
            'status' => Status::all(),
            'order' => $order
        ];

        return view('admin.orders.edit', compact('data'));
    }

    public function update(OrderRequest $request, Order $order)
    {
        $deliveryDate = $request->order['delivery_date'] . ' ' . $request->order['delivery_hour'];

        $order->update([
            'delivery_date' => $deliveryDate,
            'customer_id' => $request->order['customer_id'],
            'status_id' => $request->order['status_id'],
        ]);

        foreach ($order->orderProducts as $orderProduct) {
            $orderProduct->delete();
        }

        foreach ($request->order['product'] as $productRequestData) {
            $product = Product::findOrFail($productRequestData['id']);

            OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product->id,
                'quantity' => $productRequestData['quantity'],
                'price' => $product->price,
                'kg' => $productRequestData['kg'] ?? null
            ]);
        }

        return redirect()
            ->route('admin.orders.index')
            ->with('msg_success', 'Pedido atualizado com sucesso!');
    }

    // public function destroy(User $user)
    // {
        
    //     $user->delete();

    //     return redirect()
    //         ->route('admin.users.index')
    //         ->with('msg_success', 'Usuário deletado com sucesso!');
    // }
}
