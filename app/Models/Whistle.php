<?php

namespace App\Models;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Whistle extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'no_hp',
        'email',
        'tindakan',
        'nama_terlapor',
        'jabatan_terlapor',
        'tanggal_waktu',
        'lokasi_kejadian',
        'kronologis',
        'nominal_korupsi',
        'foto_bukti',
        'status',
        'alasan',
    ];

    protected $casts = [
        'tanggal_waktu' => 'datetime',
        'nominal_korupsi' => 'decimal:2',
    ];
    // relasi ke id_user
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
