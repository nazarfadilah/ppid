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
                $item->alamat_pemohon,
                $item->pekerjaan_pemohon,
                $item->no_hp_pemohon,
                $item->email_pemohon,
                $item->nama_kuasa_pemohon,
                $item->alamat_kuasa_pemohon,
                $item->no_hp_kuasa_pemohon,
                $item->alasan_pengajuan,
                $item->kasus_posisi,
                $item->created_at->format('Y-m-d'),
                $item->status,
                $item->reject_reason
            ];
        });
    }

    public function headings(): array
    {
        return [
            'Nama Pemohon', 
            'Alamat Pemohon', 
            'Pekerjaan Pemohon', 
            'No HP Pemohon', 
            'Email Pemohon',
            'Nama Kuasa Pemohon',
            'Alamat Kuasa Pemohon',
            'No HP Kuasa Pemohon',
            'Alasan Pengajuan',
            'Kasus Posisi',
            'Tanggal Diajukan', 
            'Status',
            'Alasan'
        ];
    }
}
