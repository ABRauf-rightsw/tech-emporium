<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class AdminDashboardController extends Controller
{
    public function index()
    {
        $monthlyRevenue = Order::select(
            DB::raw('MONTH(created_at) as month'),
            DB::raw('SUM(total_amount) as revenue')
        )
            ->whereYear('created_at', now()->year)
            ->groupBy('month')
            ->pluck('revenue', 'month');

        return view('admin.dashboard.index', [
            'totalProducts' => Product::count(),
            'totalOrders' => Order::count(),
            'totalRevenue' => Order::sum('total_amount'),
            'totalCustomers' => User::where('role', 'user')->count(),
            'pendingOrders' => Order::where('order_status', 'pending')->count(),
            'completedOrders' => Order::where('order_status', 'delivered')->count(),
            'lowStock' => Product::where('stock', '<', 5)->count(),
            'recentOrders' => Order::with('user')->latest()->limit(10)->get(),
            'recentProducts' => Product::with(['category', 'brand'])->latest()->limit(5)->get(),
            'monthlyRevenue' => $monthlyRevenue,
        ]);
    }
}
