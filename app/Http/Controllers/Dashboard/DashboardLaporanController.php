<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Enums\LaporanStatus;
use App\Enums\UserRole;
use App\Models\Laporan;
use App\Models\Mitra;
use App\Models\Project;
use App\Models\Sektor;
use App\Models\User;
use App\Notifications\LaporanDiterimaNotification;
use Illuminate\Support\Facades\Auth;
use Inertia\Inertia;
use App\Exports\LaporanExport;
use App\Notifications\LaporanDitolakNotification;
use Maatwebsite\Excel\Facades\Excel;

class DashboardLaporanController extends Controller
{
    public function index()
    {
        $laporans = Laporan::all();
        return Inertia::render('Dashboard/Laporan/Index', ['laporan' => $laporans]);
    }

    public function create()
    {
        $sektors = Sektor::all();
        $projects = Project::all();
        return Inertia::render('Dashboard/Laporan/Create', compact('sektors', 'projects'));
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
        $status = LaporanStatus::from($request->status);
        $mitra_id = Mitra::where('user_id', $user_id)->get();

        $laporan = Laporan::create([
            'title' => $request->title,
            'status' => $status->value,
            'description' => $request->description,
            'anggaran_realisasi' => $request->anggaran_realisasi,
            'tanggal_realisasi' => $request->tanggal_realisasi,
            'mitra _id' => $mitra_id,
        ]);

        if ($laporan) {
            $admins = User::where('role', UserRole::Admin->value)->get();

            foreach ($admins as $admin) {
                $this->sendNotification($status, $admin, $laporan, $laporan);
            }

            return redirect()->route('dashboard.laporan.index')->with('success', 'Laporan berhasil dibuat');
        } else {
            return redirect()->route('dashboard.laporan.create')->with('failed', 'Laporan gagal dibuat');
        }
    }

    private function sendNotification(LaporanStatus $status, $user, $message, $laporan)
    {
        switch ($status) {
            case LaporanStatus::Diterima:
                $user->notify(new LaporanDiterimaNotification($laporan));
                break;

            case LaporanStatus::Ditolak:
            case LaporanStatus::Revisi:
                $user->notify(new LaporanDitolakNotification($laporan, $message));
                break;
        }
    }

    public function edit()
    {
        $sektors = Sektor::all();
        $projects = Project::all();

        return Inertia::render('Dashboard/Laporan/Edit', compact('laporan', 'sektors', 'projects'));
    }

    public function show(Laporan $laporan)
    {
        $laporanDetail = $laporan->load(['users', 'sektor', 'project']);

        return Inertia::render('Dashboard/Laporan/Show', [
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

        return redirect()->route('dashboard.laporan.index')->with('success', 'Laporan Berhasil Diperbaharui');
    }

    public function destroy(Laporan $laporan)
    {
        $laporan->delete();
        return redirect()->route('dashboard.laporan.index')->with('success', 'Laporan Berhasil Dihapus');
    }

    public function exportCSV()
    {
        $laporan = Laporan::select('id', 'title', 'status', 'description', 'anggaran_realisasi', 'tanggal_realisasi')->get();
        return Excel::download(new LaporanExport($laporan), 'laporan.csv');
    }

    public function updateStatus(Request $request, Laporan $laporan)
    {
        $request->validate([
            'status' => 'required|in:' . implode(',', array_column(LaporanStatus::cases(), 'value')),
        ]);

        $status = LaporanStatus::from($request->status);

        $laporan->status = $status->value;
        $laporan->save();

        if ($status !== LaporanStatus::Draft) {
            $admins = User::where('role', UserRole::Admin->value)->get();
            foreach ($admins as $admin) {
                $this->sendNotification($status, $admin, 'Status laporan telah diperbaharui.', $laporan);
            }

            $mitra = User::find($laporan->user_id);
            if ($mitra) {
                $this->sendNotification($status, $mitra, 'Status laporan anda telah diperbaharui.', $laporan);
            }
        }

        return redirect()->route('dashboard.laporan.index')->with('success', 'Status laporan berhasil diperbaharui');
    }
}
