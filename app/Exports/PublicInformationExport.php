<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class PublicInformationExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($requests)
    {
        $this->data = $requests;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                ucfirst($item->request_category),       // Kategori Permohonan
                $item->nama_pemohon,
                $item->nik,
                $item->no_hp,
                $item->email,
                $item->informasi_terkait,
                $item->status,
                $item->created_at->format('Y-m-d'),
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Kategori Permohonan',
            'Nama Pemohon',
            'NIK',
            'No HP',
            'Email',
            'Informasi Terkait',
            'Status',
            'Tanggal Permohonan'
        ];
    }
}
