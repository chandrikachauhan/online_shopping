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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('description')->nullable();
            $table->double('price',10,2);
            $table->double('campare_price',10,2)->nullable();
            $table->foreignId('categories_id')->constrained()->onDelete('cascade');
            $table->foreignId('subcategories_id')->constrained()->onDelete('cascade');
            $table->foreignId('brand_id')->constrained()->onDelete('cascade');
            $table->enum('is_featured',['Yes','No'])->default('Yes');
            $table->string('sku');
            $table->string('barcode');
            $table->enum('track_qty',['Yes','No'])->default('Yes');
            $table->string('qty');
            $table->string('status')->default(1);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
