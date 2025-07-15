<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicInformation extends Model
{
    use HasFactory;

    // Tentukan nama tabel jika tidak sesuai konvensi
    protected $table = 'public_information';

    // Tentukan kolom yang bisa diisi secara massal
    protected $fillable = [
        'name_pd_okpd',
        'document_name',
        'creation_year',
        'file_type',
        'file_size',
        'file',
    ];

    // Tentukan kolom yang tidak bisa diisi (jika ada)
    protected $guarded = [];

    // Tentukan format tanggal jika diperlukan
    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * Mendapatkan URL file terkait (misalnya jika file disimpan di storage).
     * 
     * @return string
     */
    public function getFileUrlAttribute()
    {
        return storage_path('app/public/' . $this->file);
    }
}
