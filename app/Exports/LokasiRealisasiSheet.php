<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class LokasiRealisasiSheet implements FromCollection, WithHeadings
{
    protected $realisasiLokasi;

    public function __construct($realisasiLokasi)
    {
        $this->realisasiLokasi = $realisasiLokasi;
    }

    public function collection()
    {
        return $this->realisasiLokasi->map(function ($item) {
            return [
                'Lokasi' => $item->lokasi_kecamatan,
                'Total Realisasi' => $item->total_realisasi,
            ];
        });
    }

    public function headings(): array
    {
        return ['Lokasi', 'Total Realisasi'];
    }
}