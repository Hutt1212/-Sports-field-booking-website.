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
            $table->string('sport_type')->after('name');
            $table->text('address')->after('location');
            $table->string('size')->after('address');
            $table->string('surface')->after('size');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('sports_fields', function (Blueprint $table) {
            $table->dropColumn(['sport_type', 'address', 'size', 'surface']);
        });
    }
};
