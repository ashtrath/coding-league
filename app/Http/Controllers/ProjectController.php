<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Sektor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('sektor')->get();
        return Inertia::render('Project/Index', ['project' => $projects]);
    }

    public function create()
    {
        $sektors = Sektor::all();
        return Inertia::render('Project/Create', ['sektor' => $sektors]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after:tangal_awal',
            'sektor_id' => 'required|exists:sektors.id',
        ]);

        $imagePath = $request->file('image')->store('image_project', 'public');

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'sektor_id' => $request->sektor_id,
        ]);

        return redirect()->route('project.index')->with('success', 'Project Berhasil Dibuat.');
    }

    public function edit(Project $project)
    {
        $sektors = Sektor::all();
        return Inertia::render('Project/Edit', [
            'project' => $project,
            'sektors' => $sektors
        ]);
    }

    public function update(Request $request, Project $project)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after:tangal_awal',
            'sektor_id' => 'required|exists:sektors.id',
        ]);

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($project->image);
            $imagePath = $request->file('image')->store('image_project', 'public');
            $data['image'] = $imagePath;
        }

        $project->update($data);

        return redirect()->route('project.index')->with('success', 'Project Berhasil Diperbaharui.');
    }

    public function destroy(Project $project)
    {
        Storage::disk('public')->delete($project->image);
        $project->delete();

        return redirect()->route('project.index')->with('success', 'Project Berhasil Dihapus');
    }
}
