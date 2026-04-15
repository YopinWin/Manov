<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('academic_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('quiz_name');
            $table->integer('score');
            $table->decimal('sleep_hours', 3, 1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('academic_logs');
    }
};
