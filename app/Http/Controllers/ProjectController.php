<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Inertia\Inertia;


class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::with('sektor')->get();
        return Inertia::render('Project/Index', ['project' => $projects]);
    }

    public function show(Project $project)
    {
        $project->load('sektor');

        return Inertia::render('Project/Show', [
            'project' => $project
        ]);
    }
}