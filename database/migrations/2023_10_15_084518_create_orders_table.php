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
            $table->string('phone_number');
            $table->string('email')->default('minhvqph27791@fpt.edu.vn');
            $table->string('address');
            $table->integer('service_id')->nullable();
            $table->integer('province_id')->nullable();
            $table->integer('district_id')->nullable();
            $table->integer('ward_id')->nullable();
            $table->enum('payment', ['COD', 'Paid', 'Waiting'])->nullable()->default("Waiting");
            $table->enum('status', ['pending', 'confirmed', 'shipping', 'shipped', 'completed', 'failed', 'cancel', 'refund'])->default('pending');
            $table->integer('ship_fee');
            $table->integer('total_product_amount');
            $table->integer('total');
            $table->string('coupon')->nullable();
            $table->integer('user_id')->nullable();
            $table->integer('admin_id')->nullable();
            $table->string('payment_url')->nullable();
            $table->timestamps();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
