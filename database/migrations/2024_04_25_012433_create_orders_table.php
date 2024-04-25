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
            $table->uuid('id')->primary();
            $table->foreignId('book_id')->constrained();
            $table->bigInteger('user_id')->unsigned();
            $table->string('buyer', 100);
            $table->string('transaction');
            $table->integer('price');
            $table->string('payment_method', 50)->nullable();
            $table->string('payment_url')->nullable();
            $table->dateTime('payment_time')->nullable();
            $table->string('status', 30)->default('pending');
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
