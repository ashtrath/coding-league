<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DashboardSektorRealisasiSheet implements FromCollection, WithHeadings
{
    protected $sektorRealisasi;

    public function __construct($sektorRealisasi)
    {
        $this->sektorRealisasi = $sektorRealisasi;
    }

    public function collection()
    {
        return $this->sektorRealisasi->map(function ($item) {
            return [
                'Sektor' => $item->sektor->name,
                'Total Realisasi' => $item->total_realisasi,
            ];
        });
    }

    public function headings(): array
    {
        return ['Nama Sektor', 'Total Realisasi'];
    }
}