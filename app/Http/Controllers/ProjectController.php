<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//model
use App\Models\Project;

class ProjectController extends Controller
{
    public function index()
    {
        $projects = Project::all();

        return view('projects.index', compact('projects'));
    }

    public function show(Project $project)
    {

        return view('projects.show', compact('projects'));
    }
}
