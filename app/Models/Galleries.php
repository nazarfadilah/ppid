<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Galleries extends Model
{
    use HasFactory;

    // Nama tabel yang terkait dengan model ini
    protected $table = 'galleries';

    // Kolom yang dapat diisi (mass assignable)
    protected $fillable = [
        'link',
        'title',
        'type',
        'description',
        'date',
    ];

    // Menentukan apakah kolom timestamps (created_at dan updated_at) digunakan
    public $timestamps = true;

    const TYPE_FOTO = 'foto';
    const TYPE_VIDEO = 'video';
    const TYPE_COMIC = 'comic';
    const TYPE_PODCAST = 'podcast';

    protected $casts = [
        'type' => 'string', // Pastikan type disimpan sebagai string
    ];

    /**
     * Menampilkan tanggal dalam format yang lebih mudah dibaca.
     */
    public function getDateAttribute($value)
    {
        return \Carbon\Carbon::parse($value)->format('d F Y'); // Mengubah format tanggal
    }
}
