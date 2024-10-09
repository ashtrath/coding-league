<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class DashboardStatisticsSheet implements FromArray, WithHeadings
{
    protected $totalProjectCount;
    protected $projectTerealisasiCount;
    protected $totalRealisasi;

    public function __construct($totalProjectCount, $projectTerealisasiCount, $totalRealisasi)
    {
        $this->totalProjectCount = $totalProjectCount;
        $this->projectTerealisasiCount = $projectTerealisasiCount;
        $this->totalRealisasi = $totalRealisasi;
    }

    public function array(): array
    {
        return [
            ['Total Project', 'Project Terealisasi', 'Total Dana Realisasi'],
            [$this->totalProjectCount, $this->projectTerealisasiCount, $this->totalRealisasi],
        ];
    }

    public function headings(): array
    {
        return ['Total Project', 'Project Terealisasi', 'Total Dana Realisasi'];
    }
}