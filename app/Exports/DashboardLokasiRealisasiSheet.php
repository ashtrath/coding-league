<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DashboardLokasiRealisasiSheet implements FromArray, WithHeadings
{
    protected $adminRealisasiLokasi;

    public function __construct($adminRealisasiLokasi)
    {
        $this->adminRealisasiLokasi = $adminRealisasiLokasi;
    }

    public function array(): array
    {
        $data = [];

        foreach ($this->adminRealisasiLokasi as $lokasi) {
            $data[] = [
                'Kecamantan' => $lokasi->lokasi_kecamatan,
                'Total Realisasi' => $lokasi->total_realisasi,
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return ['Kecamantan', 'Total Realisasi'];
    }
}
