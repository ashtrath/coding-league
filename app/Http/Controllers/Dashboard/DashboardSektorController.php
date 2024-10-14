<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sektor;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardSektorController extends Controller
{
    public function index()
    {
        $sektors = Sektor::all();
        return Inertia::render('Dashboard/Sektor/Index', [
            'sektor' => $sektors
        ]);
    }

    public function create()
    {
        return Inertia::render('Dashboard/Sektor/Create');
    }

    public function store(Request $request, Sektor $sektor)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($sektor->image);
            $imagePath = $request->file('image')->store('sektor_images', 'public');
            $data['image'] = $imagePath;
        }

        Sektor::create($validatedData);

        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor berhasil dibuat');
    }

    public function show(Sektor $sektors)
    {
        return Inertia::render('Dashboard/Sektor/Show', [
            'sektor' => $sektors
        ]);
    }

    public function edit(Sektor $sektors)
    {
        return Inertia::render('Dashboard/Sektor/Edit', [
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

        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor berhasil diperbarui');
    }

    public function destroy(Sektor $sektors)
    {
        $sektors->delete();

        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor berhasil dihapus');
    }
}
