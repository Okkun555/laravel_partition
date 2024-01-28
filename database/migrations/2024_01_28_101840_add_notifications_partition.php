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
        DB::statement("
            ALTER TABLE notifications
            PARTITION BY RANGE COLUMNS(`created_at`) (
                PARTITION p202312 VALUES LESS THAN ('2024-01-01'),
                PARTITION p202401 VALUES LESS THAN ('2024-02-01'),
                PARTITION p202402 VALUES LESS THAN ('2024-03-01'),
                PARTITION p202403 VALUES LESS THAN ('2024-04-01'),
                PARTITION p202404 VALUES LESS THAN ('2024-05-01'),
                PARTITION p202405 VALUES LESS THAN ('2024-06-01'),
                PARTITION p202406 VALUES LESS THAN ('2024-07-01'),
                PARTITION p202407 VALUES LESS THAN ('2024-08-01'),
                PARTITION p202408 VALUES LESS THAN ('2024-09-01'),
                PARTITION p202409 VALUES LESS THAN ('2024-10-01'),
                PARTITION p202410 VALUES LESS THAN ('2024-11-01'),
                PARTITION p202411 VALUES LESS THAN ('2024-12-01'),
                PARTITION p202412 VALUES LESS THAN ('2025-01-01')
            )
        ");
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement("ALTER TABLE notifications REMOVE PARTITIONING");
    }
};
