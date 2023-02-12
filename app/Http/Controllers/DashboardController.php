<?php

namespace App\Http\Controllers;

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
        $projects = Project::whereIsSmall(false)->get();
        $projects_sm = Project::whereIsSmall(true)->get();

        return view('dashboard', compact('projects', 'projects_sm'));
    }
}
