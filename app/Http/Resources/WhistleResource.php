<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class WhistleResource extends JsonResource
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
            'nama' => $this->nama,
            'no_hp' => $this->no_hp,
            'email' => $this->email,
            'tindakan' => $this->tindakan,
            'nama_terlapor' => $this->nama_terlapor,
            'jabatan_terlapor' => $this->jabatan_terlapor,
            'tanggal_waktu' => $this->tanggal_waktu?->format('Y-m-d H:i:s'),
            'lokasi_kejadian' => $this->lokasi_kejadian,
            'kronologis' => $this->kronologis,
            'nominal_korupsi' => $this->nominal_korupsi,
            'foto_bukti' => $this->foto_bukti,
            'status' => $this->status,
            'alasan' => $this->alasan,
            'created_at' => $this->created_at?->format('Y-m-d H:i:s'),
            'updated_at' => $this->updated_at?->format('Y-m-d H:i:s'),
        ];
    }
}
