<?php
namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Laporan;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use App\Exports\DataExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;

class DashboardController extends Controller
{
    // Data Statistik
    public function index() {
        $projectsWithLaporan = Project::whereHas('laporans')->with('laporans')->get();

        $totalAnggaranRealisasi = Laporan::sum('anggaran_realisasi');

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
        $totalRealisasi = Laporan::sum('anggaran_realisasi');

        $sektorRealisasi = Laporan::select('sektor_id', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->groupBy('sektor_id')
            ->with('sektor:id,name')
            ->get();

        $realisasiLokasi = Laporan::select('lokasi_kecamatan', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->groupBy('lokasi_kecamatan')
            ->get();

        return Excel::download(new DashboardExport($totalProjectCount, $projectTerealisasiCount, $totalRealisasi, $sektorRealisasi, $realisasiLokasi), 'dashboard_data.xlsx');
    }
}