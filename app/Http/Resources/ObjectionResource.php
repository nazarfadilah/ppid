<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ObjectionResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'user_id' => $this->user_id,
            'name' => $this->user ? $this->user->name : null,
            'nama_pemohon' => $this->nama_pemohon,
            'alamat_pemohon' => $this->alamat_pemohon,
            'pekerjaan_pemohon' => $this->pekerjaan_pemohon,
            'no_hp_pemohon' => $this->no_hp_pemohon,
            'email_pemohon' => $this->email_pemohon,
            'nama_kuasa_pemohon' => $this->nama_kuasa_pemohon,
            'alamat_kuasa_pemohon' => $this->alamat_kuasa_pemohon,
            'no_hp_kuasa_pemohon' => $this->no_hp_kuasa_pemohon,
            'alasan_pengajuan' => $this->alasan_pengajuan,
            'kasus_posisi' => $this->kasus_posisi,
            'ktp_pemohon' => $this->ktp_pemohon,
            'status' => $this->status,
            'reject_reason' => $this->reject_reason,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
