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
        $table->string('name', 255);
        $table->string('slug', 255)->unique()->nullable(); // prevent insert error
        $table->text('description')->nullable();
        $table->string('sku', 50)->unique()->nullable();   // prevent insert error
        $table->decimal('price', 10, 2)->default(0)->unsigned();
        $table->unsignedInteger('stock')->default(0);
        $table->foreignId('product_category_id')
            ->nullable()
            ->constrained('product_categories')
            ->nullOnDelete()
            ->cascadeOnUpdate();
        $table->string('image_url', 255)->nullable();
        $table->boolean('is_active')->default(true);
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