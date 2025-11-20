<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up()
{
    Schema::table('courses', function (Blueprint $table) {
        $table->string('video')->nullable()->after('image');
        $table->text('video_description')->nullable()->after('video');
    });
}

public function down()
{
    Schema::table('courses', function (Blueprint $table) {
        $table->dropColumn(['video', 'video_description']);
    });
}

};
