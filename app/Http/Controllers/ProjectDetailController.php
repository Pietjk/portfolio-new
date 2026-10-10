<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\ProjectDetail;
use App\Traits\ImageManagement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class ProjectDetailController extends Controller
{
    use ImageManagement;

    /**
     * Display the project details page for a specific project.
     *
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
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'string', 'min:3'],
            'subtitle' => ['nullable', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'image_path' => ['nullable', 'image', 'max:3000'],
        ]);

        unset($validated['image_path']);

        if ($path = $this->storeImage($request)) {
            $validated['image_path'] = $path;
        }

        ProjectDetail::create($validated);

        return redirect('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
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
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ProjectDetail $projectDetail)
    {
        $validated = $request->validate([
            'project_id' => ['required', 'exists:projects,id'],
            'title' => ['required', 'string', 'min:3'],
            'subtitle' => ['nullable', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'image_path' => ['nullable', 'image', 'max:3000'],
        ]);

        unset($validated['image_path']);

        if ($path = $this->storeImage($request)) {
            $this->deleteImage($projectDetail->image_path);
            $validated['image_path'] = $path;
        }

        $projectDetail->update($validated);

        return redirect('dashboard');
    }

    /**
     * Remove the uploaded image of the specified resource.
     */
    public function destroyImage(ProjectDetail $projectDetail): RedirectResponse
    {
        return $this->removeImage($projectDetail);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(ProjectDetail $projectDetail)
    {
        $this->deleteImage($projectDetail->image_path);

        $projectDetail->delete();

        return back();
    }
}
