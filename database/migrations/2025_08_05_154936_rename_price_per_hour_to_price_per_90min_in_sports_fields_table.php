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
            $table->renameColumn('price_per_hour', 'price_per_90min');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sports_fields', function (Blueprint $table) {
            $table->renameColumn('price_per_90min', 'price_per_hour');
        });
    }
};
