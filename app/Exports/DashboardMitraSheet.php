<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DashboardMitraSheet implements FromArray, WithHeadings
{
    protected $adminRealisasiMitra;

    public function __construct($adminRealisasiMitra)
    {
        $this->adminRealisasiMitra = $adminRealisasiMitra;
    }

    public function array(): array
    {
        $data = [];

        foreach ($this->adminRealisasiMitra as $mitra) {
            $data[] = [
                'Mitra' => $mitra->name_company,
                'Total Realisasi' => $mitra->total_realisasi,
            ];
        }

        return $data;
    }

    public function headings(): array
    {
        return ['Mitra', 'Total Realisasi'];
    }
}