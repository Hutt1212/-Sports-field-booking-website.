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
            // Thêm các trường mới cho thanh toán ngân hàng
            $table->string('bank_name')->nullable()->after('bkash_ref');
            $table->string('bank_account')->nullable()->after('bank_name');
            $table->string('transaction_id')->nullable()->after('bank_account');
            $table->text('payment_notes')->nullable()->after('transaction_id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('bookings', function (Blueprint $table) {
            $table->dropColumn(['bank_name', 'bank_account', 'transaction_id', 'payment_notes']);
        });
    }
};
