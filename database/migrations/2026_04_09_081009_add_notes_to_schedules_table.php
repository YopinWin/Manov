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
        Schema::table('schedules', function (Blueprint $table) {
            // Tambahkan kolom notes, kasih nullable agar tidak error kalau dikosongkan
            $table->text('notes')->nullable()->after('intensity');
        });
    }

    public function down(): void
    {
        Schema::table('schedules', function (Blueprint $table) {
            // Hapus kolom notes kalau perintah rollback dijalankan
            $table->dropColumn('notes');
        });
    }
};
