<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sektor;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class DashboardSektorController extends Controller
{
    private $sektorImageFolder = 'sektor_images';
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

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'nullable|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        DB::transaction(function () use ($request) {
            $this->ensureSektorImageFolderExists();

            $imagePath = $request->file('image')->store($this->sektorImageFolder, 'public');
            Sektor::create([
                'image' => $imagePath,
            ]);
        });

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
        $request->validate([
            'image' => 'required|string|max:255',
            'name' => 'required|string|max:255',
            'description' => 'nullable',
        ]);

        DB::transaction(function () use ($request, $sektors) {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $this->ensureSektorImageFolderExists();

                if ($sektors->image) {
                    Storage::disk('public')->delete($sektors->image);
                }

                $imagePath = $request->file('image')->store($this->sektorImageFolder, 'public');
                $data['image'] = $imagePath;
            }
            $sektors->update($data);
        });
        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor berhasil diperbarui');
    }

    public function destroy(Sektor $sektors)
    {
        $sektors->delete();

        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor berhasil dihapus');
    }

    private function ensureSektorImageFolderExists()
    {
        if (!Storage::disk('public')->exists($this->sektorImageFolder)) {
            Storage::disk('public')->makeDirectory($this->sektorImageFolder);
        }
    }
}
