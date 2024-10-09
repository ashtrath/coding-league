<?php
namespace App\Http\Controllers;

use App\Enums\LaporanStatus;
use App\Models\Mitra;
use App\Models\Laporan;
use App\Models\Project;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;
use App\Exports\AdminDashboardExport;

class DashboardController extends Controller
{
    // Data Statistik
    public function index() {
        $projectsWithLaporan = Project::whereHas('laporans')->with('laporans')->get();

        $totalAnggaranRealisasi = Laporan::where('status', LaporanStatus::Diterima->value)->sum('anggaran_realisasi');

        $laporanData = Laporan::select('id', 'title', 'status', 'anggaran_realisasi', 'tanggal_realisasi')
                               ->with(['mitra:id,nama', 'sektor:id,nama', 'project:id,nama'])
                               ->get();

        $totalProjectCount = Project::count();
        
        return Inertia::render('Dashboard/Index', [
            'mitra' => Mitra::all(),
            'laporans' => $laporanData,
            'mitraCount' => Mitra::count(),
            'laporanCount' => Laporan::count(),
            'projectCount' => $projectsWithLaporan->count(),
            'totalProjectCount' => $totalProjectCount,
            'totalAnggaranRealisasi' => $totalAnggaranRealisasi,
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

        $adminRealisasiMitra = Mitra::select('name_company', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))->groupBy('name_company')->get();
            
        $adminRealisasiLokasi = Laporan::select('lokasi_kecamatan', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->groupBy('lokasi_kecamatan')
            ->get();


        return Excel::download(new AdminDashboardExport($totalAdminProjectCount, $adminProjectTerealisasiCount, $adminTotalMitra, $totalAdminRealisasi, $adminSektorRealisasi, $adminRealisasiMitra ,$adminRealisasiLokasi), 'admin_dashboard_data.xlsx');
    }
}