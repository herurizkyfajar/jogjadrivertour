<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Check if duration_days exists (old column) and duration_info doesn't exist
        $hasDurationDays = Schema::hasColumn('tours', 'duration_days');
        $hasDurationInfo = Schema::hasColumn('tours', 'duration_info');

        if ($hasDurationDays && !$hasDurationInfo) {
            // MySQL: rename + change type via raw SQL
            DB::statement('ALTER TABLE tours CHANGE duration_days duration_info TEXT NOT NULL');
        } elseif (!$hasDurationInfo) {
            // Neither exists, add it
            DB::statement('ALTER TABLE tours ADD COLUMN duration_info TEXT NOT NULL DEFAULT ""');
        }
        // If duration_info already exists, do nothing

        // Drop old columns if they exist
        $columnsToDrop = [];
        foreach (['duration_nights', 'max_participants', 'location', 'city', 'asal_negara'] as $col) {
            if (Schema::hasColumn('tours', $col)) {
                $columnsToDrop[] = $col;
            }
        }
        if (!empty($columnsToDrop)) {
            Schema::table('tours', function (Blueprint $table) use ($columnsToDrop) {
                $table->dropColumn($columnsToDrop);
            });
        }
    }

    public function down(): void
    {
        // Not reversible safely
    }
};
