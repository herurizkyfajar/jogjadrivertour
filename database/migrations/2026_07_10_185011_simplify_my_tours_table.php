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
        Schema::table('my_tours', function (Blueprint $table) {
            $table->dropColumn(['client_name', 'tour_name', 'description', 'travel_date', 'is_featured']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('my_tours', function (Blueprint $table) {
            $table->string('client_name');
            $table->string('tour_name');
            $table->text('description')->nullable();
            $table->date('travel_date')->nullable();
            $table->boolean('is_featured')->default(false);
        });
    }
};
