<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('sales', function(Blueprint $table){
            $table->foreign('user_id')->references('id')->on('users');
            $table->foreign('customer_id')->references('id')->on('customers');
        });

        Schema::table('detail_sales', function(Blueprint $table){
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->foreign('product_id')->references('id')->on('products');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sales', function(Blueprint $table){
            $table->dropForeign(['user_id']);
            $table->dropForeign(['customer_id']);
        });

        Schema::table('detail_sales', function(Blueprint $table){
            $table->dropForeign(['sale_id']);
            $table->dropForeign(['product_id']);
        });
    }
};
