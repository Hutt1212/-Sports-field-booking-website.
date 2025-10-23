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
        Schema::table('bookings', function (Blueprint $table) {
            $table->string('payment_method')->nullable()->after('status'); // cash, bkash
            $table->string('payment_status')->default('pending')->after('payment_method'); // pending, paid, refunded
            $table->string('bkash_txn')->nullable()->after('payment_status');
            $table->string('bkash_ref')->nullable()->after('bkash_txn');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['payment_method', 'payment_status', 'bkash_txn', 'bkash_ref']);
        });
    }
};
