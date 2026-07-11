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
        Schema::create('my_tours', function (Blueprint $table) {
            $table->id();
            $table->string('client_name');
            $table->string('tour_name');
            $table->text('description')->nullable();
            $table->string('image');
            $table->string('negara_asal');
            $table->date('travel_date')->nullable();
            $table->boolean('is_featured')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('my_tours');
    }
};
