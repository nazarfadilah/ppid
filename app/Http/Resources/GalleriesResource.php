<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class GalleriesResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id'          => $this->id,
            'link'        => $this->link,
            'title'       => $this->title,
            'type'        => $this->type,
            'description' => $this->description,
            'date'        => $this->date, // already formatted by accessor
            'file_path'   => $this->file_path, // Assuming file_path is a storage path
            'created_at'  => $this->created_at,
            'updated_at'  => $this->updated_at,
        ];
    }
}
