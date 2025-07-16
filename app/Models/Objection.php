<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Http\Resources\ObjectionResource;
use App\Models\User;
class Objection extends Model
{
    use HasFactory;

    protected $table = 'objection';

    protected $fillable = [
        'nama_pemohon',
        'alamat_pemohon',
        'pekerjaan_pemohon',
        'no_hp_pemohon',
        'email_pemohon',
        'nama_kuasa_pemohon',
        'alamat_kuasa_pemohon',
        'no_hp_kuasa_pemohon',
        'alasan_pengajuan',
        'kasus_posisi',
        'ktp_pemohon',
        'status',
        'reject_reason',
    ];

    public $timestamps = true;

    // Jika ingin menampilkan status dengan huruf kapital di awal
    public function getStatusAttribute($value)
    {
        return ucfirst($value);
    }
    // relasi ke id_user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
