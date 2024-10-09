<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AdminDashboardExport implements WithMultipleSheets
{
    protected $totalAdminProjectCount;
    protected $adminProjectTerealisasiCount;
    protected $adminTotalMitra;
    protected $totalAdminRealisasi;
    protected $adminSektorRealisasi;
    protected $adminRealisasiMitra;
    protected $adminRealisasiLokasi;

    public function __construct($totalAdminProjectCount, $adminProjectTerealisasiCount, $adminTotalMitra, $totalAdminRealisasi, $adminSektorRealisasi, $adminRealisasiMitra, $adminRealisasiLokasi)
    {
        $this->totalAdminProjectCount = $totalAdminProjectCount;
        $this->adminProjectTerealisasiCount = $adminProjectTerealisasiCount;
        $this->adminTotalMitra = $adminTotalMitra;
        $this->totalAdminRealisasi = $totalAdminRealisasi;
        $this->adminSektorRealisasi = $adminSektorRealisasi;
        $this->adminRealisasiMitra = $adminRealisasiMitra;
        $this->adminRealisasiLokasi = $adminRealisasiLokasi;
    }

    public function sheets(): array
    {
        return [
            new AdminDashboardStatisticsSheet($this->totalAdminProjectCount, $this->adminProjectTerealisasiCount, $this->adminTotalMitra, $this->totalAdminRealisasi),
            new DashboardSektorRealisasiSheet($this->adminSektorRealisasi),
            new DashboardMitraSheet($this->adminRealisasiMitra),
            new DashboardLokasiRealisasiSheet($this->adminRealisasiLokasi),
        ];
    }
}