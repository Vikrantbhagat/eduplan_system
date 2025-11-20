<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        // Schema::create('purchases', function (Blueprint $table) {
        //     $table->id();
        //     $table->foreignId('user_id')->constrained()->onDelete('cascade');
        //     $table->foreignId('course_id')->constrained()->onDelete('cascade');
        //     $table->timestamps();
        // });

        // database/migrations/xxxx_xx_xx_create_purchases_table.php
Schema::create('purchases', function (Blueprint $table) {
    $table->id();
    $table->unsignedBigInteger('user_id'); // student
    $table->unsignedBigInteger('course_id');
    $table->string('transaction_id')->unique();
    $table->decimal('amount', 10, 2);
    $table->string('payment_status')->default('completed'); // completed, failed, pending
    $table->string('payment_method')->nullable(); // stripe, razorpay, paypal, etc.
    $table->timestamp('purchased_at')->default(DB::raw('CURRENT_TIMESTAMP'));
    $table->timestamps();

    $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
    $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
});

    }

    public function down(): void
    {
        Schema::dropIfExists('purchases');
    }
};
