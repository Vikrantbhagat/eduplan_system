<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('course_reviews')) {
            Schema::create('course_reviews', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('course_id');
                $table->unsignedBigInteger('user_id');
                $table->tinyInteger('rating')->default(0);
                $table->text('review')->nullable();
                $table->timestamps();

                $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
                $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('course_reviews');
    }
};
