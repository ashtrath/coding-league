<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DashboardExport implements WithMultipleSheets
{
    protected $totalProjectCount;
    protected $projectTerealisasiCount;
    protected $totalRealisasi;
    protected $sektorRealisasi;
    protected $realisasiLokasi;

    public function __construct($totalProjectCount, $projectTerealisasiCount, $totalRealisasi, $sektorRealisasi, $realisasiLokasi)
    {
        $this->totalProjectCount = $totalProjectCount;
        $this->projectTerealisasiCount = $projectTerealisasiCount;
        $this->totalRealisasi = $totalRealisasi;
        $this->sektorRealisasi = $sektorRealisasi;
        $this->realisasiLokasi = $realisasiLokasi;
    }

    public function sheets(): array
    {
        return [
            new DashboardStatisticsSheet($this->totalProjectCount, $this->projectTerealisasiCount, $this->totalRealisasi),
            new DashboardSektorRealisasiSheet($this->sektorRealisasi),
            new DashboardLokasiRealisasiSheet($this->realisasiLokasi),
        ];
    }
}