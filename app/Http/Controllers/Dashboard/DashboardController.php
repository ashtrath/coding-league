<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Enums\LaporanStatus;
use App\Enums\MitraStatus;
use App\Enums\ProjectStatus;
use App\Models\Mitra;
use App\Models\Laporan;
use App\Models\Project;
use App\Models\Sektor;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\DashboardExport;
use App\Exports\AdminDashboardExport;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    // Data Statistik
    public function index()
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

        // Laporan Anggaran per Sektor
        $totalAnggaran = Laporan::sum('anggaran_realisasi');

        $topSectors = Laporan::select('sektor_id', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->groupBy('sektor_id')
            ->with('sektor:id,name')
            ->orderByDesc('total_realisasi')
            ->take(6)
            ->get();

        $remainingSectorsTotal = Laporan::select(DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->whereNotIn('sektor_id', $topSectors->pluck('sektor_id'))
            ->first()
            ->total_realisasi;

        $anggaranSektorCSR = $topSectors->map(function ($item, $index = 1) use ($totalAnggaran) {
            return [
                'name' => $item->sektor->name,
                'total_anggaran' => $item->total_realisasi,
                'percentage' => ($item->total_realisasi / $totalAnggaran) * 100,
                'fill' => "var(--chart-" . ($index + 1) . ")",
            ];
        });

        if ($remainingSectorsTotal) {
            $anggaranSektorCSR->push([
                'name' => 'Lainnya',
                'total_anggaran' => $remainingSectorsTotal,
                'percentage' => ($remainingSectorsTotal / $totalAnggaran) * 100,
                'fill' => 'var(--charts-7)'
            ]);
        }

        // Laporan Anggaran per PT
        $topMitra = Laporan::select('mitra_id', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->groupBy('mitra_id')
            ->with('mitra:id,name_company')
            ->orderByDesc('total_realisasi')
            ->take(8)
            ->get();

        $remainingMitraTotal = Laporan::select(DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->whereNotIn('mitra_id', $topMitra->pluck('mitra_id'))
            ->first()
            ->total_realisasi;

        $anggaranMitrasCSR = $topMitra->map(function ($item, $index = 1) {
            return [
                'name' => $item->mitra->name_company,
                'total_anggaran' => $item->total_realisasi,
                'fill' => "var(--chart-" . ($index + 1) . ")",
            ];
        });

        if ($remainingMitraTotal) {
            $anggaranMitrasCSR->push([
                'name' => 'Lainnya',
                'total_anggaran' => $remainingMitraTotal,
                'fill' => 'var(--charts-9)'
            ]);
        }

        // Laporan Anggaran per Kecamatan
        $topKecamatan = Laporan::select('projects.lokasi_kecamatan', DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->join('projects', 'laporans.project_id', '=', 'projects.id')
            ->groupBy('projects.lokasi_kecamatan')
            ->orderByDesc('total_realisasi')
            ->take(8)
            ->get();

        $remainingKecamatanTotal = Laporan::select(DB::raw('SUM(anggaran_realisasi) as total_realisasi'))
            ->join('projects', 'laporans.project_id', '=', 'projects.id')
            ->whereNotIn('projects.lokasi_kecamatan', $topKecamatan->pluck('lokasi_kecamatan'))
            ->first()
            ->total_realisasi;

        $anggaranKecamatansCSR = $topKecamatan->map(function ($item, $index = 1) {
            return [
                'name' => $item->lokasi_kecamatan,
                'total_anggaran' => $item->total_realisasi,
                'fill' => "var(--chart-" . ($index + 1) . ")",
            ];
        });

        if ($remainingKecamatanTotal) {
            $anggaranKecamatansCSR->push([
                'name' => 'Lainnya',
                'total_anggaran' => $remainingKecamatanTotal,
                'fill' => 'var(--charts-9)'
            ]);
        }

        // For Filters
        $mitras = Mitra::select('id', 'name_mitra', 'name_company')->get();
        $sektors = Sektor::select('id', 'name')->get();

        return Inertia::render('Dashboard/index', compact('mitras', 'sektors', 'analytics', 'anggaranSektorCSR', 'anggaranMitrasCSR', 'anggaranKecamatansCSR'));
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

        return Excel::download(new AdminDashboardExport($totalAdminProjectCount, $adminProjectTerealisasiCount, $adminTotalMitra, $totalAdminRealisasi, $adminSektorRealisasi, $adminRealisasiMitra, $adminRealisasiLokasi), 'admin_dashboard_data.xlsx');
    }
}
