<?php

namespace App\Exports;

use App\Models\Sale;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
class SaleExport implements FromView
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function view():View
    {
         $sales = Sale::with('detailSale.product', 'customer')->get();
         return view('module.sale.excel', compact('sales'));
    }
}
