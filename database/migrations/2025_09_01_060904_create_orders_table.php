<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('email', 30)->nullable();
            $table->string('phone', 20)->nullable();
            $table->decimal('amount', 10, 2);
            $table->text('address')->nullable();
            $table->string('status', 10)->default('pending');
            $table->string('transaction_id', 255)->nullable();
            $table->string('currency', 20)->default('BDT');
            $table->string('payment_method', 50)->nullable();
            $table->json('items')->nullable(); // Store order items as JSON
            $table->json('progress')->nullable(); // Store progress steps as JSON
            $table->timestamp('estimated_delivery')->nullable();
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
