<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Sektor;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Exports\ProjectExport;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;


class DashboardProjectController extends Controller
{
    private $projectImageFolder = 'project_images';

    public function index()
    {
        $projects = Project::with('sektor')->get();
        return Inertia::render('Dashboard/Project/Index', ['project' => $projects]);
    }

    public function create()
    {
        $sektors = Sektor::all();
        return Inertia::render('Dashboard/Project/Create', ['sektor' => $sektors]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'required|string|max:255',
            'lokasi_kecamatan' => 'required|string|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after:tanggal_awal',
            'sektor_id' => 'required|exists:sektors.id',
        ]);

        DB::transaction(function () use ($request) {
            $this->ensureProjectImageFolderExists();

            $imagePath = $request->file('image')->store($this->projectImageFolder, 'public');

            Project::create([
                'title' => $request->title,
                'description' => $request->description,
                'image' => $imagePath,
                'lokasi_kecamatan' => $request->lokasi_kecamatan,
                'tanggal_awal' => $request->tanggal_awal,
                'tanggal_akhir' => $request->tanggal_akhir,
                'sektor_id' => $request->sektor_id,
            ]);
        });

        return redirect()->route('dashboard.project.index')->with('success', 'Project Berhasil Dibuat.');
    }

    public function show(Project $project)
    {
        $project->load('sektor');

        return Inertia::render('Dashboard/Project/Show', [
            'project' => $project
        ]);
    }

    public function edit(Project $project)
    {
        $sektors = Sektor::all();
        return Inertia::render('Dashboard/Project/Edit', [
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
            'lokasi_kecamatan' => 'required|string|max:255',
            'tanggal_awal' => 'required|date',
            'tanggal_akhir' => 'required|date|after:tanggal_awal',
            'sektor_id' => 'required|exists:sektors.id',
        ]);
        DB::transaction(function () use ($request, $project) {
            $data = $request->except('image');

            if ($request->hasFile('image')) {
                $this->ensureProjectImageFolderExists();

                if ($project->image) {
                    Storage::disk('public')->delete($project->image);
                }

                $imagePath = $request->file('image')->store($this->projectImageFolder, 'public');
                $data['image'] = $imagePath;
            }

            $project->update($data);
        });
        return redirect()->route('dashboard.project.index')->with('success', 'Project Berhasil Diperbaharui.');
    }

    public function destroy(Project $project)
    {
        Storage::disk('public')->delete($project->image);
        $project->delete();

        return redirect()->route('dashboard.project.index')->with('success', 'Project Berhasil Dihapus');
    }

    public function exportCSV()
    {
        $project = Project::select('id', 'title', 'description', 'image', 'lokasi_kecamatan', 'tanggal_awal', 'tanggal_akhir', 'tanggal_diterbitkan', 'status')->get();
        return Excel::download(new ProjectExport($project), 'project.csv');
    }

    public function updateProjectStatus(Request $request, $id)
    {
        $project = Project::findOrFail($id);
        $project->status = $request->status;
        $project->save();

        return redirect()->back()->with('success', 'Status Project Berhasil Diupdate.');
    }

    private function ensureProjectImageFolderExists()
    {
        if (!Storage::disk('public')->exists($this->projectImageFolder)) {
            Storage::disk('public')->makeDirectory($this->projectImageFolder);
        }
    }
}
