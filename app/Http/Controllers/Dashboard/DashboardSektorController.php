<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Sektor;
use Inertia\Inertia;
use Illuminate\Support\Str;

class DashboardSektorController extends Controller
{
    public function index()
    {
        $sektors = Sektor::all();
        return Inertia::render('Dashboard/Sektor/index', [
            'sektor' => $sektors
        ]);
    }

    public function create()
    {
        return Inertia::render('Dashboard/Sektor/create');
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'image' => 'required|image|mimes:png,jpg,jpeg|max:10240',
            'name' => 'required|string|max:255',
            'description' => 'required',
        ]);

        if ($request->hasFile('image')) {
            $image = $request->file('image');

            $imageName = Str::ulid() . "." . $image->getClientOriginalExtension();
            $imagePath = $image->storeAs('images/sektor_images', $imageName, 'public');
            $validatedData['image'] = "$imagePath";
        }

        Sektor::create($validatedData);

        return redirect()->route('dashboard.sektor.index')->with('success', 'Sektor berhasil dibuat');
    }

    public function show(Sektor $sektors)
    {
        return Inertia::render('Dashboard/Sektor/show', [
            'sektor' => $sektors
        ]);
    }

    public function edit(Sektor $sektors)
    {
        return Inertia::render('Dashboard/Sektor/edit', [
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
