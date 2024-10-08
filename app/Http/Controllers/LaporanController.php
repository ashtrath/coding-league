<?php

namespace App\Http\Controllers;

use App\Enums\LaporanStatus;
use App\Models\Laporan;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Response;
use Inertia\Inertia;

class LaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::all();
        return Inertia::render('Laporan/Index', ['laporan' => $laporans]);
    }

    public function create()
    {
        $sektors = Sektor::all();
        $projects = Project::all();
        return Inertia::render('Laporan/Create', compact('sektors', 'projects'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:' . implode(',', array_column(LaporanStatus::cases(), 'value')),
            'description' => 'string',
            'anggaran_realisasi' => 'required|numeric|between:0,99999999.99',
            'tanggal_realisasi' => 'required|date',
        ]);

        $user_id = Auth::id();

        Laporan::create([
            'user_id' => $user_id,
            'title' => $request->title,
            'status' => $request->status,
            'description' => $request->description,
            'anggaran_realisasi' => $request->anggaran_realisasi,
            'tanggal_realisasi' => $request->tanggal_realisasi,
        ]);

        return redirect()->route('laporan.index')->with('success', 'Laporan berhasil dibuat');
    }

    public function edit()
    {
        $sektors = Sektor::all();
        $projects = Project::all();

        return Inertia::render('Laporan/Edit', compact('laporan', 'sektors', 'projects'));
    }

    public function show(Laporan $laporan)
    {
        $laporanDetail = $laporan->load(['users', 'sektor', 'project']);

        return Inertia::render('Laporan/Show', [
            'laporan' => $laporanDetail,
        ]);
    }

    public function update(Request $request, Laporan $laporan)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'status' => 'required|in:' . implode(',', array_column(LaporanStatus::cases(), 'value')),
            'description' => 'string',
            'anggaran_realisasi' => 'required|numeric|between:0,99999999.99',
            'tanggal_realisasi' => 'required|date',
        ]);

        $laporan->update($request->all());

        return redirect()->route('laporan.index')->with('success', 'Laporan Berhasil Diperbaharui');
    }

    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('laporan.index')->with('success', 'Laporan Berhasil Dihapus');
    }
}
