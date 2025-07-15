<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ObjectionExport implements FromCollection, WithHeadings
{
    protected $data;

    public function __construct($objections)
    {
        $this->data = $objections;
    }

    public function collection()
    {
        return $this->data->map(function ($item) {
            return [
                $item->nama_pemohon,
                $item->nik,
                $item->alasan_keberatan,
                $item->created_at->format('Y-m-d'),
                $item->status
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Pemohon', 'NIK', 'Alasan Keberatan', 'Tanggal Diajukan', 'Status'];
    }
}
