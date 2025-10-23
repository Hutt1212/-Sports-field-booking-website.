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
        Schema::table('sports_fields', function (Blueprint $table) {
            $table->json('time_slots')->nullable()->after('closing_time');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sports_fields', function (Blueprint $table) {
            $table->dropColumn('time_slots');
        });
    }
};
