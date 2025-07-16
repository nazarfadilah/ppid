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
                ucfirst($item->request_category),
                $item->nama_pemohon,
                $item->nik,
                $item->no_hp,
                $item->email,
                $item->informasi_terkait,
                $item->alasan_informasi,
                $item->nama_pengguna_informasi,
                $item->nik_pengguna_informasi,
                $item->alamat_pengguna_informasi,
                $item->no_hp_pengguna_informasi,
                $item->email_pengguna_informasi,
                $item->alasan_pengguna_informasi,
                $item->cara_mendapatkan_informasi,
                $item->cara_mendapatkan_informasi_lainnya,
                $item->formats,
                $item->format_lainnya,
                $item->pengiriman_informasi,
                $item->pengiriman_informasi_lainnya,
                $item->ktp ? 'Ada' : 'Tidak Ada',
                $item->status,
                $item->reject_reason,
                $item->created_at->format('Y-m-d')
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
            'Alasan Informasi',
            'Nama Pengguna Informasi',
            'NIK Pengguna Informasi',
            'Alamat Pengguna Informasi',
            'No HP Pengguna Informasi',
            'Email Pengguna Informasi',
            'Alasan Pengguna Informasi',
            'Cara Mendapatkan Informasi',
            'Cara Mendapatkan Informasi Lainnya',
            'Format Informasi',
            'Format Informasi Lainnya',
            'Pengiriman Informasi',
            'Pengiriman Informasi Lainnya',
            'KTP',
            'Status',
            'Alasan',
            'Tanggal Permohonan'
        ];
    }
}
