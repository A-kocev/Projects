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
            $table->string('full_name', 255);
            $table->string('email');
            $table->string('country', 255);
            $table->string('city', 255);
            $table->integer('zip_code');
            $table->string('address', 255);
            $table->string('discount_code', 255)->nullable();
            $table->enum('status', ['preparing', 'shipped', 'delivered']);
            $table->decimal('total_amount');
            $table->softDeletes();
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
