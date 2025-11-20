<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ Prevent duplicate creation
        if (!Schema::hasTable('lectures')) {
            Schema::create('lectures', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('course_id');
                $table->string('title');
                $table->text('description')->nullable();
                $table->string('video_url')->nullable();
                $table->integer('duration')->nullable();
                $table->timestamps();

                $table->foreign('course_id')
                      ->references('id')
                      ->on('courses')
                      ->onDelete('cascade');
            });
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('lectures');
    }
};
