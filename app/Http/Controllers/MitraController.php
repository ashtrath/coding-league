<?php

namespace App\Http\Controllers;

use App\Models\Mitra;
use Inertia\Inertia;

class MitraController extends Controller
{

    public function index()
    {
        $mitras = Mitra::all();
        return Inertia::render('Mitra/Index', ['mitras' => $mitras]);
    }

    public function show(Mitra $mitra)
    {
        return Inertia::render('Mitra/Show', ['mitra' => $mitra]);
    }

}
