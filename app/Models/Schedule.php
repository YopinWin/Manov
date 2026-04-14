<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;

    /**
     * Nama tabel di database (Opsional jika nama tabelnya 'schedules')
     */
    protected $table = 'schedules';

    /**
     * Mass Assignment Protection
     * Daftarkan kolom 'day' dan 'notes' agar bisa disimpan oleh Controller
     */
    protected $fillable = [
        'course_name', 
        'day',         // Kolom baru untuk Weekly Planning
        'start_time', 
        'end_time', 
        'intensity', 
        'notes'        // Tambahkan notes biar sistem bisa nyimpen catatan AI
    ];

    /**
     * Casting tipe data (Opsional)
     * Agar Laravel otomatis mengenali start_time dan end_time sebagai format waktu
     */
    protected $casts = [
        'start_time' => 'string',
        'end_time' => 'string',
        'intensity' => 'integer',
    ];
}