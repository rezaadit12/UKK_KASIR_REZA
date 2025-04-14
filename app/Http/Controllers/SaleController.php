<?php

namespace App\Http\Controllers;

use App\Exports\SaleExport;
use App\Models\Customer;
use App\Models\DetailSale;
use App\Models\Product;
use App\Models\Sale;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use Str;

class SaleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sales = Sale::with('detailSale.product', 'customer', 'user')->get();

        return view('module.sale.index', compact('sales'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $products = Product::all();
        return view('module.sale.create', compact('products'));
    }
    

    public function transaction(Request $request)
    {
        $data = $this->separateRequest($request->all());
        $products = $data[0];
        $totalPay = $data[1];
        return view('module.sale.transaction', compact('products','totalPay'));
    }

    public function storeOrMember(Request $request)
    {
        if(!isset($request->phone)){
            return $this->storeNonMember($request);
        }

        $customer = Customer::where('phone', $request->phone)->first();
        $point = $request->total / 100;
        if($customer){
            $customer_id = $customer->id;
            $customer->update(['point' => $customer->point + $point]);
        }else{
            $newCustomer = Customer::create([
                'phone' => $request->phone,
                'point' => $point,
            ]);
            $customer_id = $newCustomer->id;
        }
        
        // $pointDidapat = $$request->total / 100;


        $createSale = $this->createSale($request, $customer_id, $point);
        return redirect()->route('createMember', ['sale_id' => $createSale]);
    }

    public function createMember($sale_id)
    {
        $sale = Sale::with('detailSale.product', 'customer')->where('id', $sale_id)->first();
        $customer = Customer::where('id', $sale->customer_id)->first();

        $checkAblePoint = Sale::where('customer_id', $customer->id)->count();
        $checkAblePoint > 1 ? $checkPoint = true : $checkPoint = false;

        if($customer->point > $sale->total_price){
            $customer['point'] = $sale->total_price;
        }

        return view('module.sale.member-transaction', compact('sale','customer', 'checkPoint'));
    }

    public function storeMember(Request $request)
    {
        if(!$request->username){
            return redirect()->back()->with('error', 'Nama member harus diisi!');
        }else{
            $customer = Customer::where('id', $request->customer_id)->first();

            if ($customer && !$customer->username) {
                $customer->update(['name' => $request->username]);
            }
        }

        if(isset($request->checkPoint)){

            $customerPointCustomer = Customer::where('id', $request->customer_id)->first();

            $customerAblePoint = Sale::where('customer_id', $request->customer_id)->count();
            if($customerAblePoint <= 1 ){
                return redirect()->back()->with('error', 'poin tidak dapat ditukarkan!');
            };


            $customerPointCustomer->update(['point' => $customerPointCustomer->point - $request->checkPoint]);

            Sale::findOrFail($request->sale_id)->update(['point_exchanged'  => $request->checkPoint]);
        }

        return redirect()->route('saleInvoice', ['sale_id' => $request->sale_id]);
    }

    public function storeNonMember(Request $request)
    {
        $createSale = $this->createSale($request);
        return redirect()->route('saleInvoice', ['sale_id' => $createSale]);
    }

    public function saleInvoice($sale_id)
    {
        $sale = Sale::with('detailSale.product', 'customer', 'user')->where('id', $sale_id)->first();
        $customer = Customer::where('id', $sale->customer_id)->first();

        // dd($customer);

        return view('module.sale.invoice', compact('sale','customer'));
    }

    public function exportPDF($sale_id)
    {
        $sale = Sale::with('detailSale.product', 'customer')->where('id', $sale_id)->first();

        // return view('module.sale.pdf', compact('sale'));
        $pdf = Pdf::loadView('module.sale.pdf', compact('sale'));
        $idUnique = explode('-', $sale->id);
        return $pdf->download('bukti-pembayaran-'.$idUnique[0].'.pdf');

    }
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $sale = Sale::with('detailSale.product', 'user')->where('id', $id)->first();
        $customer = Customer::where('id', $sale->customer_id)->first();
        return view('module.sale.detail', compact('sale', 'customer'));
    }

    public function exportEXCEL()
    {
        // $sales = Sale::with('detailSale.product', 'customer')->get();
        // return view('module.sale.excel', compact('sales'));
        return Excel::download(new SaleExport, 'data-penjualan.xlsx');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    protected function separateRequest($request)
    {
        $products = $request['products'];
        foreach($products as $items){
            $item  = explode(';', $items);
            $product[] = [
                'id' => $item[0],
                'name'=> $item[1],
                'price' => $item[2],
                'quantity' => $item[3],
                'totalPrice' => $item[4],
            ];
        }

        $totalPay = 0;
        foreach($product as $tPay){
            $totalPay += $tPay['totalPrice'];
        }

        return [$product, $totalPay];
    }

    protected function createSale($request, $customer_id=null, $point=null)
    {
        $products = json_decode($request->input('products'), true);
        $sale = Sale::create([
            'user_id' => Auth::user()->id,
            'customer_id' => $customer_id,
            'point_collected' => $point,
            'total_price' => $request->total,
            'total_pay' => $request->totalPay,
            'total_return' => $request->totalPay - $request->total,
            'sale_date' => Carbon::now(),
        ]);

        $sale_id = $sale->id;

        if ($sale) {
            $data = [];
            $totalPay = 0;
            foreach ($products as $product) {
                $data[] = [
                    'id' => Str::uuid(),
                    'sale_id' => $sale_id,
                    'product_id' => $product['id'],
                    'quantity' => $product['quantity'],
                    'total_price' => $product['totalPrice'],
                    'created_at' => Carbon::now(),
                    'updated_at' => Carbon::now(),
                ];
                $totalPay += $product['totalPrice'];
                Product::where('id', $product['id'])->decrement('stock', $product['quantity']);
            }
            DetailSale::insert($data);
        }
        return $sale;
    }
}
