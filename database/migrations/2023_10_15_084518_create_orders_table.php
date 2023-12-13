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
            $table->uuid('id')->primary();
            $table->string('order_code')->uniqid();
            $table->string('name');
            $table->string('email');
            $table->string('phone_number');
            $table->string('address');
            $table->enum('payment', ['COD', 'Paid'])->default('COD');
            $table->enum('status', ['pending', 'shipping', 'shipped', 'completed', 'failed'])->default('pending');
            $table->integer('total');
            $table->integer('coupon')->nullable();
            $table->integer('user_id');
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
