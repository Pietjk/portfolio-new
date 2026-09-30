<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectDetailController extends Controller
{
    /**
     * Display the project details page for a specific project.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function show(Project $project)
    {
        $projectDetails = $project->projectDetails()->get();

        return view('project_details.show', compact('project', 'projectDetails'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $projects = Project::orderBy('title')->get();
        $project_id = $request->project_id;

        return view('project_details.create', compact('projects', 'project_id'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'string', 'min:3'],
            'subtitle' => ['nullable', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'image_path' => ['nullable', 'image', 'max:3000']
        ]);

        unset($validated['image_path']);

        if ($request->file('image_path') !== null) {
            $path = $request->file('image_path')->store(
                'images',
                'public'
            );

            $validated['image_path'] = 'storage/'.$path;
        }

        ProjectDetail::create($validated);

        return redirect('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ProjectDetail  $projectDetail
     * @return \Illuminate\Http\Response
     */
    public function edit(ProjectDetail $projectDetail)
    {
        $projects = Project::orderBy('title')->get();

        return view('project_details.edit', compact('projectDetail', 'projects'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ProjectDetail  $projectDetail
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectDetail $projectDetail)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'string', 'min:3'],
            'subtitle' => ['nullable', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'image_path' => ['nullable', 'image', 'max:3000']
        ]);

        unset($validated['image_path']);

        if ($request->file('image_path') !== null) {
            $image_path = str_replace('storage/', '', $projectDetail->image_path);
            Storage::disk('public')->delete($image_path);

            $path = $request->file('image_path')->store(
                'images',
                'public'
            );

            $validated['image_path'] = 'storage/'.$path;
        }

        $projectDetail->update($validated);

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\ProjectDetail  $projectDetail
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectDetail $projectDetail)
    {
        if ($projectDetail->image_path) {
            $image = str_replace('storage/', '', $projectDetail->image_path);
            Storage::disk('public')->delete($image);
        }

        $projectDetail->delete();

        return back();
    }
}
