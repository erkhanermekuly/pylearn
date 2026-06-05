<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('lessons', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('content');
        });

        Schema::table('tests', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('questions');
        });

        Schema::table('assignments', function (Blueprint $table) {
            $table->json('translations')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('lessons', fn (Blueprint $table) => $table->dropColumn('translations'));
        Schema::table('tests', fn (Blueprint $table) => $table->dropColumn('translations'));
        Schema::table('assignments', fn (Blueprint $table) => $table->dropColumn('translations'));
    }
};
