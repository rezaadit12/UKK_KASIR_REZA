<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\UserController;
use App\Models\Product;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/', function () {
    return view('module.dashboard.admin');
})->middleware(['AUTH']);



Route::get('/login', [AuthController::class, 'index'])->name('login')->middleware('GUEST');
Route::post('/login', [AuthController::class,'loginStore'])->name('loginStore')->middleware('GUEST');


Route::middleware(['AUTH'])->group(function () {
    
    Route::get('/logout', [AuthController::class,'logout'])->name('logout');

    Route::get('/', [DashboardController::class,'index'])->name('dashboard');


    Route::get('product', [ProductController::class, 'index'])->name('product.index');
    Route::resource('product', ProductController::class)->except('index')->middleware('ADMIN');
    

    Route::resource('sale', SaleController::class);
    Route::resource('user', UserController::class);

    Route::resource('product', ProductController::class)->except('index')->middleware('ADMIN');

    Route::get('/product/updateStock/{id}', [ProductController::class,'updateStock'])->name('updateStock');

    Route::prefix('sale/')->group(function () {
        Route::post('transaction', [SaleController::class,'transaction'])->name('transaction');
        Route::post('storeOrMember', [SaleController::class,'storeOrMember'])->name('storeOrMember');
        Route::get('createMember/{sale_id}', [SaleController::class,'createMember'])->name('createMember');
        Route::post('storeMember', [SaleController::class,'storeMember'])->name('storeMember');
        Route::get('saleInvoice/{sale_id}', [SaleController::class,'saleInvoice'])->name('saleInvoice');
        Route::get('exportPDF/{sale_id}', [SaleController::class,'exportPDF'])->name('exportPDF');
        Route::get('export/exportEXCEL', [SaleController::class,'exportEXCEL'])->name('exportEXCEL');
    });
});