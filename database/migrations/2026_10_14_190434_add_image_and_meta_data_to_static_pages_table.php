<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('static_pages', function (Blueprint $table) {
            $table->string('image')->nullable()->after('content');
            $table->json('meta_data')->nullable()->after('image');
        });
    }

    public function down(): void
    {
        Schema::table('static_pages', function (Blueprint $table) {
            $table->dropColumn(['image', 'meta_data']);
        });
    }
};
