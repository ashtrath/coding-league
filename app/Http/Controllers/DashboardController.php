<?php
namespace App\Http\Controllers;

use App\Models\Mitra;
use App\Models\Laporan;
use App\Models\Project;
use Illuminate\Http\Request;
use Inertia\Inertia;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index() {
        $projectsWithLaporan = Project::whereExists(function ($query) {
            $query->select(DB::raw(1))
                  ->from('laporans')
                  ->whereColumn('laporans.project_id', 'projects.id');
        })->with('laporans')->get();

        $totalAnggaranRealisasi = Laporan::sum('anggaran_realisasi');

        $laporanData = Laporan::select('id', 'title', 'status', 'anggaran_realisasi', 'tanggal_realisasi')
                               ->with(['mitra:id,nama', 'sektor:id,nama', 'project:id,nama'])
                               ->get();

        $totalProjectCount = Project::count();
        
        return Inertia::render('Dashboard/Index', [
            'mitra' => Mitra::all(),
            'laporans' => $laporanData,
            'projects' => $projectsWithLaporan,
            'mitraCount' => Mitra::count(),
            'laporanCount' => Laporan::count(),
            'projectCount' => $projectsWithLaporan->count(),
            'totalProjectCount' => $totalProjectCount,
            'totalAnggaranRealisasi' => $$totalAnggaranRealisasi,
        ]);
    }
}