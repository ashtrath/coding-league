<?php

namespace App\Repositories;

use App\Enums\LaporanStatus;
use App\Models\Laporan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class DashboardRepository
{
    public function getAnggaranStatistics()
    {
        $data = Cache::remember('anggaran_statistics', 60, function () {
            return Laporan::select(
                'sektors.name as sektor_name',
                'mitras.name_company as mitra_name',
                'projects.lokasi_kecamatan as lokasi_kecamatan',
                DB::raw('SUM(anggaran_realisasi) as total_anggaran'),
                DB::raw('SUM(anggaran_realisasi) / (SELECT SUM(anggaran_realisasi) FROM laporans) * 100 as percentage')
            )
            ->join('sektors', 'sektors.id', '=', 'laporans.sektor_id')
            ->join('mitras', 'mitras.id', '=', 'laporans.mitra_id')
            ->join('projects', 'projects.id', '=', 'laporans.project_id')
            ->where('laporans.status', '=', LaporanStatus::Diterima->value) // Fully qualify the column
            ->groupBy('sektors.name', 'mitras.name_company', 'projects.lokasi_kecamatan')
            ->get();
        });

        return [
            'sektor' => $this->getTopAndOthers($data->groupBy('sektor_name'), 6, 'sektor_name'),
            'mitra' => $this->getTopAndOthers($data->groupBy('mitra_name'), 8, 'mitra_name'),
            'kecamatan' => $this->getTopAndOthers($data->groupBy('lokasi_kecamatan'), 8, 'lokasi_kecamatan'),
        ];
    }


    private function getTopAndOthers($items, $topN, $groupKey)
    {
        $topItems = $items->map(function($group) use ($groupKey) {
            $name = $group[0]->{$groupKey};

            return [
                'name' => $name,
                'total_anggaran' => $group->sum('total_anggaran'),
                'persentase' => $group->sum('percentage'),
            ];
        })->sortByDesc('total_anggaran')->take($topN);

        $others = $items->slice($topN);
        $totalOthers = $others->sum(function ($group) {
            return $group->sum('total_anggaran');
        });
        $percentageOthers = $others->sum(function ($group) {
            return $group->sum('percentage');
        });

        $result = $topItems->values()->toArray();

        if ($totalOthers > 0) {
            $result[] = [
                'name' => 'Lainnya',
                'total_anggaran' => $totalOthers,
                'persentase' => $percentageOthers,
            ];
        }

        return $result;
    }

}
