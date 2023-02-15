<?php

namespace App\Http\Controllers;

use App\Models\AboutText;
use App\Models\Project;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allProjects = Project::all();
        $projects = $allProjects->where('is_small', '=', false);
        $projects_sm = $allProjects->where('is_small', '=', true);
        $aboutTexts = AboutText::all();

        return view('dashboard', compact('projects', 'projects_sm', 'aboutTexts'));
    }
}
