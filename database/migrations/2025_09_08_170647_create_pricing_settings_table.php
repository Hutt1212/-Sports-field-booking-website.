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
        Schema::create('pricing_settings', function (Blueprint $table) {
            $table->id();
            $table->time('peak_start_time')->default('18:00:00');
            $table->integer('peak_surcharge')->default(2000); // in Taka
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pricing_settings');
    }
};
