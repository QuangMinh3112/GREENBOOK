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
            $table->string('name');
            $table->string('image');
            $table->integer('detail_image');
            $table->integer('price');
            $table->string('author');
            $table->integer('category_id');
            $table->text('description');
            $table->text('short_description');
            $table->string('slug');
            $table->string('published_company');
            $table->date('pushlished_year');
            $table->tinyInteger('width');
            $table->tinyInteger('height');
            $table->integer('quantity');
            $table->tinyInteger('status');
            $table->tinyInteger('sale');
            $table->integer('number_of_pages');
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
