<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Enums\LaporanStatus;
use App\Enums\MitraStatus;
use App\Enums\ProjectStatus;
use App\Models\Mitra;
use App\Models\Laporan;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;
use App\Exports\AdminDashboardExport;
use App\Repositories\DashboardRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request, DashboardRepository $dashboardRepository)
    {
        // Analytics
        $total_project = Project::where('status', ProjectStatus::Terbit->value)->count();
        $total_project_terealisasi = Project::whereHas('laporans')->count();
        $total_anggaran_realisasi = Laporan::where('status', LaporanStatus::Diterima->value)->sum('anggaran_realisasi');

        $analytics = collect([
            'total_project' => $total_project,
            'total_project_terealisasi' => $total_project_terealisasi,
            'total_anggaran_realisasi' => $total_anggaran_realisasi,
        ]);
        if (Auth::user()->role === 'Admin') {
            $analytics->put('total_mitra', Mitra::where('status', MitraStatus::Active->value)->count());
        }

        // Chart Data
        $chartData = $dashboardRepository->getAnggaranStatistics();

        // Filter
        $filter = $dashboardRepository->getFilterOption();

        return Inertia::render('Dashboard/index', [
            'data' => [
                'chartData' => $chartData,
                'analytics' => $analytics,
                'filter' => $filter,
            ]
        ]);
    }

    public function exportAllData()
    {
        $totalProjectCount = Project::count();
        $projectTerealisasiCount = Laporan::distinct('project_id')->count();
        $totalRealisasi = Laporan::where('status', LaporanStatus::Diterima->value)->sum('anggaran_realisasi');

        $sektorRealisasi = Laporan::select('sektor_id', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->groupBy('sektor_id')
            ->with('sektor:id,name')
            ->get();

        $realisasiLokasi = Laporan::select('lokasi_kecamatan', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->groupBy('lokasi_kecamatan')
            ->get();

        return Excel::download(new DashboardExport($totalProjectCount, $projectTerealisasiCount, $totalRealisasi, $sektorRealisasi, $realisasiLokasi), 'dashboard_data.xlsx');
    }

    public function exportAdminData()
    {
        $totalAdminProjectCount = Project::count();
        $adminProjectTerealisasiCount = Laporan::distinct('project_id')->where('status', LaporanStatus::Diterima->value)->count();
        $adminTotalMitra = Mitra::count();
        $totalAdminRealisasi = Laporan::where('status', LaporanStatus::Diterima->value)->sum('anggaran_realisasi');

        $adminSektorRealisasi = Laporan::select('sektor_id', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->groupBy('sektor_id')
            ->with('sektor:id,name')
            ->get();

        $adminRealisasiMitra = Laporan::join('mitras', 'laporans.mitra_id', '=', 'mitras.id')
        ->select('mitras.name_company', DB::raw('SUM(laporans.anggaran_realisasi) as total_realisasi'))
        ->groupBy('mitras.name_company')
        ->get();
        

        $adminRealisasiLokasi = Laporan::join('projects', 'laporans.project_id', '=', 'projects.id')
        ->select('projects.lokasi_kecamatan', DB::raw('SUM(laporans.anggaran_realisasi) as total_realisasi'))
        ->groupBy('projects.lokasi_kecamatan')
        ->get();


        return Excel::download(new AdminDashboardExport($totalAdminProjectCount, $adminProjectTerealisasiCount, $adminTotalMitra, $totalAdminRealisasi, $adminSektorRealisasi, $adminRealisasiMitra, $adminRealisasiLokasi), 'admin_dashboard_data.xlsx');
    }
}
