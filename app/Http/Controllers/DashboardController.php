<?php

namespace App\Http\Controllers;

use App\Models\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        if (Auth::user()->role == 'admin') {
            return $this->admin();
        } else if (Auth::user()->role == 'petugas') {
            return $this->petugas();
        }
    }

    public function admin()
    {
        $sales = DB::select('SELECT
                                    sale_date, COUNT(*) as totalSale
                                    FROM sales GROUP BY sale_date');

        $products = DB::select('SELECT
                                        p.name, SUM(ds.quantity) AS totalSold
                                        FROM detail_sales ds
                                        LEFT JOIN products p ON p.id = ds.product_id
                                        GROUP BY p.name');



        return view('module.dashboard.admin', compact('sales', 'products'));
    }

    public function petugas()
    {
        $countToday = Sale::whereDate('sale_date', now())->count();
        $totalPenjualan = Sale::whereDate('sale_date', now())->get();

        $totalToday = 0;
        foreach($totalPenjualan as $total){
            $totalToday += $total->total_price;
        }

        $lastUpdate = Sale::orderBy('id', 'DESC')->pluck('updated_at')->first();
        return view('module.dashboard.petugas', compact('countToday', 'lastUpdate', 'totalToday'));
    }
}
