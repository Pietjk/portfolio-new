<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $is_small = $request->is_small;
        return view('projects.create', compact('is_small'));
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
            'title' => ['required', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'site' => ['nullable', 'url'],
            'github' => ['nullable', 'url'],
            'image_path' => ['required', 'image', 'max:3000'],
            'is_small' => ['required', 'boolean']
        ]);

        unset($validated['image_path']);

        $path = $request->file('image_path')->store(
            'images',
            'public'
        );

        $validated['image_path'] = 'storage/'.$path;

        Project::create($validated);

        return redirect('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        return view('projects.edit', compact('project'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Project $project)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'site' => ['nullable', 'url'],
            'github' => ['nullable', 'url'],
            'image_path' => ['nullable', 'image', 'max:3000'],
            'is_small' => ['nullable', 'boolean']
        ]);

        unset($validated['image_path']);

        if ($request->file('image_path') !== null)
        {
            $image_path = str_replace('storage/', '', $project->image_path);
            Storage::disk('public')->delete($image_path);

            $path = $request->file('image_path')->store(
                'images',
                'public'
            );

            $validated['image_path'] = 'storage/'.$path;
        }

        $project->update($validated);

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Project  $project
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $image = str_replace('storage/', '', $project->image_path);
        Storage::disk('public')->delete($image);
        $project->delete();
        return back();
    }
}
