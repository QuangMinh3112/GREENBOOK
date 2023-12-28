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
        Schema::create('coupons', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('code')->nullable();
            $table->integer('value')->nullable();
            $table->enum('type', ['number', 'percent'])->nullable();
            $table->integer('quantity')->default(1);
            $table->dateTime('start_date')->nullable();
            $table->integer('used_count')->default(0);
            $table->dateTime('end_date')->nullable();
            $table->integer('point_required')->default(100);
            $table->integer('price_required')->default(0);
            $table->enum('status', ['public', 'private'])->default('public');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('coupons');
    }
};
