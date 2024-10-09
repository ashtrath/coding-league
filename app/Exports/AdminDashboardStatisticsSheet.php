<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\FromArray;
use Maatwebsite\Excel\Concerns\WithHeadings;

class AdminDashboardStatisticsSheet implements FromArray, WithHeadings
{
    protected $totalAdminProjectCount;
    protected $adminProjectTerealisasiCount;
    protected $adminTotalMitra;
    protected $totalAdminRealisasi;

    public function __construct($totalAdminProjectCount, $adminProjectTerealisasiCount, $adminTotalMitra, $totalAdminRealisasi)
    {
        $this->totalAdminProjectCount = $totalAdminProjectCount;
        $this->adminProjectTerealisasiCount = $adminProjectTerealisasiCount;
        $this->adminTotalMitra = $adminTotalMitra;
        $this->totalAdminRealisasi = $totalAdminRealisasi;
    }

    public function array(): array
    {
        return [
            [$this->totalAdminProjectCount, $this->adminProjectTerealisasiCount, $this->adminTotalMitra, $this->totalAdminRealisasi],
        ];
    }

    public function headings(): array
    {
        return ['Total Project', 'Project Terealisasi', 'Mitra Bergabung', 'Total Dana Realisasi'];
    }
}