<?php

namespace App\Http\Controllers;

use App\Models\Sektor;
use Inertia\Inertia;

class SektorController extends Controller
{
    public function index()
    {
        $sektors = Sektor::all();
        return Inertia::render('Sektor/Index', [
            'sektor' => $sektors
        ]);
    }

    public function show(Sektor $sektors)
    {
        return Inertia::render('Sektor/Show', [
            'sektor' => $sektors
        ]);
    }

}