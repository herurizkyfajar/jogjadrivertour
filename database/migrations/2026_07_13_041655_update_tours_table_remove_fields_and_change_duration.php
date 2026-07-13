<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->dropColumn(['duration_nights', 'max_participants', 'location', 'city', 'asal_negara']);
            $table->renameColumn('duration_days', 'duration_info');
        });

        Schema::table('tours', function (Blueprint $table) {
            $table->text('duration_info')->change();
        });
    }

    public function down(): void
    {
        Schema::table('tours', function (Blueprint $table) {
            $table->integer('duration_days')->default(1);
            $table->integer('duration_nights')->default(0);
            $table->integer('max_participants')->default(10);
            $table->string('location')->default('');
            $table->string('city')->default('Yogyakarta');
            $table->string('asal_negara')->nullable();
            $table->dropColumn('duration_info');
        });
    }
};
