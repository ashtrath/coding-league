<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
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

    public function create()
    {
        return Inertia::render('Sektor/Create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        Sektor::create($validatedData);

        return redirect()->route('sektor.index')->with('success', 'Sektor berhasil dibuat');
    }

    public function show(Sektor $sektors)
    {
        return Inertia::render('Sektor/Show', [
            'sektor' => $sektors
        ]);
    }

    public function edit(Sektor $sektors)
    {
        return Inertia::render('Sektor/Edit', [
            'sektor' => $sektors
        ]);
    }

    public function update(Request $request, Sektor $sektors)
    {
        $validatedData = $request->validate([
            'image' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable',
        ]);

        $sektors->update($validatedData);

        return redirect()->route('sektor.index')->with('success', 'Sektor berhasil diperbarui');
    }

    public function destroy(Sektor $sektors)
    {
        $sektors->delete();

        return redirect()->route('sektor.index')->with('success', 'Sektor berhasil dihapus');
    }
}