<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\{User, Customer, Order, Product};

class DashboardController extends Controller
{
    public function index()
    {
        $data = [
            'users_count' => User::count(),
            'customers_count' => Customer::count(),
            'products_count' => Product::count(),
            'orders_count' => Order::count()
        ];

        return view('admin.dashboard.index', compact('data'));
    }
}
