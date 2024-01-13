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
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->string('image')->default('books/cover.png');
            $table->integer('detail_image')->nullable();
            $table->string('author')->nullable();
            $table->integer('category_id')->nullable();
            $table->longText('description')->nullable();
            $table->text('short_description')->nullable();
            $table->string('slug')->nullable();
            $table->year('published_year')->nullable();
            $table->tinyInteger('width')->nullable();
            $table->tinyInteger('length')->nullable();
            $table->tinyInteger('status')->nullable();
            $table->integer('number_of_pages')->nullable();
            $table->integer('view')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('books');
    }
};
