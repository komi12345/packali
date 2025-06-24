<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

use App\Models\Order;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class AnalyticsController extends Controller
{
    public function index(Request $request)
    {
        $period = $request->input('period', 'today'); // Default to 'today'
        $startDate = null;
        $endDate = Carbon::now()->endOfDay();

        switch ($period) {
            case 'this_week':
                $startDate = Carbon::now()->startOfWeek();
                break;
            case 'this_month':
                $startDate = Carbon::now()->startOfMonth();
                break;
            case 'this_year':
                $startDate = Carbon::now()->startOfYear();
                break;
            case 'all_time':
                $startDate = null; // No start date for all time
                break;
            case 'today':
            default:
                $startDate = Carbon::now()->startOfDay();
                break;
        }

        // Requête de base pour les commandes
        $ordersQuery = Order::query();
        if ($startDate) {
            $ordersQuery->where('order_date', '>=', $startDate);
        }
        $ordersQuery->where('order_date', '<=', $endDate);

        $orders = $ordersQuery->get();

        // Statistiques des commandes
        $deliveredOrders = $orders->where('status', 'livré');
        $pendingOrders = $orders->where('status', '!=', 'livré');

        $stats = [
            'delivered_orders_count' => $deliveredOrders->count(),
            'delivered_orders_value' => $deliveredOrders->sum('total_price'),
            'pending_orders_count' => $pendingOrders->count(),
            'pending_orders_value' => $pendingOrders->sum('total_price'),
            'total_sales_period' => $deliveredOrders->sum('total_price'), // Total sales for the period are based on delivered orders
            'sales_history' => [],
        ];

        // Historique des ventes pour la période (simplifié, agrégé par jour)
        $salesHistoryQuery = Order::where('status', 'livré');
        if ($startDate) {
            $salesHistoryQuery->where('order_date', '>=', $startDate);
        }
        $salesHistoryQuery->where('order_date', '<=', $endDate);

        $salesHistory = $salesHistoryQuery
            ->select(DB::raw('DATE(order_date) as date'), DB::raw('SUM(total_price) as total'))
            ->groupBy('date')
            ->orderBy('date', 'asc')
            ->get()
            ->map(function ($item) {
                return ['date' => Carbon::parse($item->date)->format('d/m/Y'), 'total' => $item->total];
            });

        $stats['sales_history'] = $salesHistory;

        return view('admin.analytics.index', compact('stats'));
    }
}
