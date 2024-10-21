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
        Schema::create('invoice_product_details', function (Blueprint $table) {
            $table->id(); // Unique ID for the product detail row
            $table->foreignId('invoice_id')->constrained('invoices')->onDelete('cascade'); // Foreign key to 'invoices'
            $table->string('product_name'); // Product name
            $table->integer('quantity'); // Quantity of product
            $table->decimal('price', 10, 2); // Price per unit
            $table->decimal('total_price', 10, 2); // Calculated total price (quantity * price)
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoice_product_details');
    }
};
