<?php

namespace App\Http\Controllers;

use App\Models\AboutText;
use App\Models\Category;
use App\Models\Employer;
use App\Models\Experience;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\Skill;

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
        $projectDetails = ProjectDetail::with('project')->get();

        $categories = Category::all();
        $skills = Skill::with('category')->get();
        $employers = Employer::orderBy('name')->get();
        $experiences = Experience::with('employer')->orderByDesc('start_date')->get();

        return view('dashboard', compact('projects', 'projects_sm', 'aboutTexts', 'projectDetails', 'categories', 'skills', 'employers', 'experiences'));
    }
}
