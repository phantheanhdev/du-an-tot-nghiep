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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('qr_code');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->string('note')->nullable();
            $table->double('price', 9, 0);
            $table->double('total_price', 9, 0);
            $table->integer('status');
            $table->string('customer_name');
            $table->string('customer_phone');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
