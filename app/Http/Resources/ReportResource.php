<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ReportResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'     => $this->id,
            'file'   => $this->file,
            'photo'  => $this->photo,
            'type'   => $this->type,   // Uses getTypeAttribute accessor
            'year'   => $this->year,
            'status' => $this->status, // Uses getStatusAttribute accessor
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
