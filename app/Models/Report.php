<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Report extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'reports';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'file',
        'photo',
        'type',
        'year',
        'status',
    ];

    // Menentukan apakah kolom timestamps (created_at dan updated_at) digunakan
    public $timestamps = true;

    /**
     * Menampilkan tipe laporan dalam format lebih ramah pengguna.
     */
    public function getTypeAttribute($value)
    {
        return ucfirst($value); // Misalnya, mengubah "ppid" menjadi "Ppid"
    }

    /**
     * Menampilkan status laporan dalam format lebih ramah pengguna.
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Misalnya, mengubah "private" menjadi "Private"
    }
}
