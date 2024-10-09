<?php

namespace App\Http\Controllers;

use App\Models\Kegiatan;
use Inertia\Inertia;

class KegiatanController extends Controller
{
    public function index()
    {
        $kegiatans = Kegiatan::with('tags')->paginate(10);
        
        return Inertia::render('Kegiatan/Index', [
            'kegiatans' => $kegiatans
        ]);
    }

    public function show(Kegiatan $kegiatan)
    {
        $kegiatan->load('tags');
        
        return Inertia::render('Kegiatan/Show', [
            'kegiatan' => $kegiatan
        ]);
    }
}