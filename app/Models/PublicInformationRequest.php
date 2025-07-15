<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PublicInformationRequest extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'public_information_requests';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
    'request_category',
    'nama_pemohon',
    'nik',
    'no_hp',
    'email',
    'informasi_terkait',
    'alasan_informasi',
    'nama_pengguna_informasi',
    'nik_pengguna_informasi',
    'alamat_pengguna_informasi',
    'no_hp_pengguna_informasi',
    'email_pengguna_informasi',
    'alasan_pengguna_informasi',
    'cara_mendapatkan_informasi',
    'cara_mendapatkan_informasi_lainnya',
    'formats',
    'format_lainnya',
    'pengiriman_informasi',
    'pengiriman_informasi_lainnya',
    'ktp',
    'status',
    'reject_reason',
];


    // Menentukan apakah kolom timestamps (created_at dan updated_at) digunakan
    public $timestamps = true;

    /**
     * Menampilkan status dalam format lebih ramah pengguna.
     */
    public function getStatusAttribute($value)
    {
        return ucfirst($value); // Misalnya, mengubah "approved" menjadi "Approved"
    }

    /**
     * Menampilkan kategori permohonan dalam format yang lebih ramah pengguna.
     */
    public function getRequestCategoryAttribute($value)
    {
        return ucfirst($value); // Misalnya, mengubah "individual" menjadi "Individual"
    }
}
