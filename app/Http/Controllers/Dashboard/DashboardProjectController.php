<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Project;
use App\Models\Sektor;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use App\Exports\ProjectExport;
use Maatwebsite\Excel\Facades\Excel;


class DashboardProjectController extends Controller
{
    public function index(Request $request)
    {
        $perPage = $request->input('perPage', 5);
        $page = $request->input('page', 1);
        $query = Project::select(['id', 'title', 'description', 'image', 'lokasi_kecamatan', 'tanggal_awal', 'tanggal_akhir', 'tanggal_diterbitkan', 'status', 'sektor_id',]);

        $projects = $query->paginate($perPage, ['*'], 'page', $page);

        return Inertia::render('Dashboard/Project/index', [
            'data' => $projects->items(),
            'pagination' => [
                'total' => $projects->total(),
                'per_page' => $projects->perPage(),
                'current_page' => $projects->currentPage(),
                'last_page' => $projects->lastPage(),
                'from' => $projects->firstItem(),
                'to' => $projects->lastItem(),
                'next_page_url' => $projects->nextPageUrl(),
                'prev_page_url' => $projects->previousPageUrl(),
            ],
        ]);
    }

    public function create()
    {
        $sektors = Sektor::all();
        return Inertia::render('Dashboard/Project/create', [
            'sektor' => $sektors,
        ]);
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

        $imagePath = $request->file('image')->store('image_project', 'public');

        Project::create([
            'title' => $request->title,
            'description' => $request->description,
            'image' => $imagePath,
            'lokasi_kecamatan' => $request->lokasi_kecamatan,
            'tanggal_awal' => $request->tanggal_awal,
            'tanggal_akhir' => $request->tanggal_akhir,
            'sektor_id' => $request->sektor_id,
        ]);

        return redirect()->route('dashboard.project.index')->with('success', 'Project Berhasil Dibuat.');
    }

    public function show(Project $project)
    {
        $project->load('sektor');

        return Inertia::render('Dashboard/Project/show', [
            'project' => $project
        ]);
    }

    public function edit(Project $project)
    {
        $sektors = Sektor::all();
        return Inertia::render('Dashboard/Project/edit', [
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

        $data = $request->except('image');

        if ($request->hasFile('image')) {
            Storage::disk('public')->delete($project->image);
            $imagePath = $request->file('image')->store('image_project', 'public');
            $data['image'] = $imagePath;
        }

        $project->update($data);

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
}