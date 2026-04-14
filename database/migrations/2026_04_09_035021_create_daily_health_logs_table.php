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
        Schema::create('daily_health_logs', function (Blueprint $table) {
            $table->id();
            $table->integer('water_intake')->default(0);
            $table->integer('sleep_hours')->default(0);
            $table->string('mood_status')->default('Neutral');
            $table->date('log_date');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('daily_health_logs');
    }
};
