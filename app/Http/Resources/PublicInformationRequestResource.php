<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicInformationRequestResource extends JsonResource
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
            'request_category' => $this->request_category,
            'nama_pemohon' => $this->nama_pemohon,
            'nik' => $this->nik,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
            'informasi_terkait' => $this->informasi_terkait,
            'alasan_informasi' => $this->alasan_informasi,
            'nama_pengguna_informasi' => $this->nama_pengguna_informasi,
            'nik_pengguna_informasi' => $this->nik_pengguna_informasi,
            'alamat_pengguna_informasi' => $this->alamat_pengguna_informasi,
            'no_hp_pengguna_informasi' => $this->no_hp_pengguna_informasi,
            'email_pengguna_informasi' => $this->email_pengguna_informasi,
            'alasan_pengguna_informasi' => $this->alasan_pengguna_informasi,
            'cara_mendapatkan_informasi' => $this->cara_mendapatkan_informasi,
            'cara_mendapatkan_informasi_lainnya' => $this->cara_mendapatkan_informasi_lainnya,
            'formats' => $this->formats,
            'format_lainnya' => $this->format_lainnya,
            'pengiriman_informasi' => $this->pengiriman_informasi,
            'pengiriman_informasi_lainnya' => $this->pengiriman_informasi_lainnya,
            'ktp' => $this->ktp,
            'status' => $this->status,
            'reject_reason' => $this->reject_reason,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
