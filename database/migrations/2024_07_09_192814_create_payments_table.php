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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('payment_id');
            // $table->foreignId('order_id')->constrained();
            $table->foreignId('user_id')->constrained();
            $table->string('status');
            $table->string('transaction_number')->nullable();
            $table->string('description')->nullable();
            $table->json('meta_data')->nullable();
            $table->string('ip')->nullable();
            $table->decimal('amount', 18, 4)->nullable();
            $table->string('amount_format')->nullable();
            $table->decimal('fee', 18, 4)->nullable();
            $table->string('fee_format')->nullable();
            $table->string('company')->nullable();
            $table->string('type')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
