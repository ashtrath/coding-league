<?php

namespace App\Http\Controllers;

use App\Models\Laporan;
use Inertia\Inertia;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::all();
        return Inertia::render('Laporan/Index', ['laporan' => $laporans]);
    }

    public function show(Laporan $laporan)
    {
        $laporanDetail = $laporan->load(['users', 'sektor', 'project']);

        return Inertia::render('Laporan/Show', [
            'laporan' => $laporanDetail,
        ]);
    }
}
