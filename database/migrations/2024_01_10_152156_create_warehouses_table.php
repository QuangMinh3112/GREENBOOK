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
        Schema::create('warehouses', function (Blueprint $table) {
            $table->id();
            $table->integer('book_id')->nullable();
            $table->integer('supplier_id')->nullable();
            $table->integer('quantity')->default(0);
            $table->integer('import_price')->default(0);
            $table->integer('retail_price')->default(0);
            $table->integer('wholesale_price')->default(0);
            $table->integer('delivery_quantity')->default(0);
            $table->integer('returned_quantity')->default(0);
            $table->integer('defective_quantity')->default(0);
            $table->integer('stock')->default(0);
            $table->timestamps();
        });
    }
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warehouses');
    }
};
