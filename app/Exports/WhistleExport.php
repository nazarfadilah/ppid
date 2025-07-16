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
            $item->user_id,
            $item->nama,
            $item->no_hp,
            $item->email,
            $item->tindakan,
            $item->nama_terlapor,
            $item->jabatan_terlapor,
            $item->tanggal_waktu,
            $item->lokasi_kejadian,
            $item->kronologis,
            $item->nominal_korupsi,
            $item->status,
            $item->alasan,
            $item->created_at->format('Y-m-d'),
            $item->updated_at->format('Y-m-d')
            ];
        });
    }
    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Nama',
            'No HP',
            'Email',
            'Tindakan',
            'Nama Terlapor',
            'Jabatan Terlapor',
            'Tanggal/Waktu',
            'Lokasi Kejadian',
            'Kronologis',
            'Nominal Korupsi',
            'Status',
            'Alasan',
            'Tanggal Diajukan',
            'Tanggal Diperbarui'
        ];
    }
}
