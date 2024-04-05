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
            $table->string('title', 255);
            $table->text('description');
            $table->decimal('price');
            $table->integer('quantity');
            $table->foreignId('category_id')->constrained('categories');
            $table->foreignId('type_id')->constrained('types');
            $table->integer('discount')->nullable();
            $table->boolean('is_featured')->nullable()->default(0);
            $table->string('weight', 255);
            $table->string('dimensions', 255);
            $table->softDeletes();
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
