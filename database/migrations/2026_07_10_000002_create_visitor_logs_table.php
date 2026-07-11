<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('visitor_logs', function (Blueprint $table) {
            $table->id();
            $table->string('ip')->nullable();
            $table->string('url');
            $table->string('page')->nullable();
            $table->string('method', 10)->default('GET');
            $table->string('user_agent')->nullable();
            $table->string('referrer')->nullable();
            $table->string('country')->nullable();
            $table->string('device')->nullable();
            $table->string('browser')->nullable();
            $table->boolean('is_unique')->default(true);
            $table->timestamp('created_at')->useCurrent();
            $table->index('created_at');
            $table->index('url');
            $table->index('ip');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('visitor_logs');
    }
};
