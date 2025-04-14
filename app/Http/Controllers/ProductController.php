<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends BaseController
{

    protected $model = Product::class;
    protected $view = 'product';
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name'=> 'required|string',
            'price'=> 'required|integer',
            'stock' => 'required|integer',
            'image'=> 'required|image',
        ]);

        if($request->hasFile('image')){
            $validate['image'] = $request->file('image')->store('products', 'public');
        }
        Product::create($validate);

        return redirect()->route('product.index')->with('success','Produk berhasil ditambahkan');
    }

    public function updateStock($id)
    {
        $product = Product::findOrFail($id);
        return view('module.product.stock-update', compact('product'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,Product $product)
    {
        if(!isset($request->stock)){ // ini untuk 'EDIT'
            $data = $request->validate([
                'name' => 'required',
                'price' => 'required|integer'
            ]);
        }else{ // ini untuk 'UPDATE STOCK'
            $data = $request->all();

            if(count($data) > 3){
                return redirect()->route("product.index")->with('error', 'inputan tidak sesuai');
            }
        }

        if($request->hasFile('image')){
            if($product->image){
                Storage::disk('public')->delete( $product->image);
            }
            $data['image'] = $request->file('image')->store('products', 'public');
        }
        $product->update($data);

        return redirect()->route('product.index')->with('success', 'Produk berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('product.index')->with('success','Berhasil dihapus');
    }
}
