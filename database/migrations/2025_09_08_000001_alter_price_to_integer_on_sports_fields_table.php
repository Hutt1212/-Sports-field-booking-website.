<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Coerce any decimal values to whole numbers (rounded)
        DB::statement('UPDATE sports_fields SET price_per_90min = ROUND(price_per_90min)');

        // Change column type to integer (whole numbers only)
        // Prefer raw SQL to avoid requiring doctrine/dbal
        // MySQL/MariaDB syntax
        DB::statement('ALTER TABLE sports_fields MODIFY price_per_90min INT NOT NULL');
    }

    public function down(): void
    {
        // Revert to decimal(8,2)
        DB::statement('ALTER TABLE sports_fields MODIFY price_per_90min DECIMAL(8,2) NOT NULL');
    }
};


