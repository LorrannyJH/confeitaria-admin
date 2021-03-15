<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User, Customer, Order, Product, Status};

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $ordersToday = Order::whereDate('delivery_date', now()->format('Y-m-d'));

        if ($request['filter'] && $request['filter']['status_id'] && $request['filter']['status_id'] != 'all'){
            $ordersToday = $ordersToday->where('status_id', $request['filter']['status_id']);
        }

        if ($request['filter'] && $request['filter']['delivery_hour'] && $request['filter']['delivery_hour'] != ''){
            $ordersToday = $ordersToday->whereRaw('HOUR(delivery_date) = ?', [$request['filter']['delivery_hour'] . ':00']);
        }
        
        $ordersToday = $ordersToday->paginate(10);

        $data = [
            'status' => Status::all(),
            'users_count' => User::count(),
            'customers_count' => Customer::count(),
            'products_count' => Product::count(),
            'orders_count' => Order::count(),
            'orders_today' => $ordersToday,
            'orders_today_filtered_status_id' => $request['filter']['status_id'] ?? null,
            'orders_today_filtered_delivery_hour' => $request['filter']['delivery_hour'] ?? null,
        ];

        return view('admin.dashboard.index', compact('data'));
    }
}
