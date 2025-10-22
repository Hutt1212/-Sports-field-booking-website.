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
        Schema::create('sports_fields', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->text('description')->nullable();
            $table->string('type'); // football, basketball, tennis, etc.
            $table->string('location');
            $table->decimal('price_per_hour', 8, 2);
            $table->string('status')->default('available'); // available, maintenance, unavailable
            $table->string('image')->nullable();
            $table->json('amenities')->nullable(); // lights, parking, changing rooms, etc.
            $table->time('opening_time');
            $table->time('closing_time');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sports_fields');
    }
};
