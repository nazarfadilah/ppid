<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class WhistleExport implements FromCollection, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    protected $data;

    public function __construct($whistles)
    {
        $this->data = $whistles;
    }
    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                $item->id,
                $item->nama,
                $item->no_hp,
                $item->email,
                $item->tindakan,
                $item->nama_terlapor,
                $item->status,
                $item->created_at->format('Y-m-d')
            ];
        });
    }
    public function headings(): array
    {
        return [
            'ID',
            'Nama',
            'No HP',
            'Email',
            'Tindakan',
            'Terlapor',
            'Status',
            'Dibuat'
        ];
    }
}
