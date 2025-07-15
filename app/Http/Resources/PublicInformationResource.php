<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PublicInformationResource extends JsonResource
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
            'name_pd_okpd' => $this->name_pd_okpd,
            'document_name' => $this->document_name,
            'creation_year' => $this->creation_year,
            'file_type' => $this->file_type,
            'file_size' => $this->file_size,
            'file' => $this->file,
            'file_url' => $this->file_url,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
