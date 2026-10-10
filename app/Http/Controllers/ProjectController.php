<?php

namespace App\Http\Controllers;

use App\Models\Project;
use App\Models\Skill;
use App\Traits\ImageManagement;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProjectController extends Controller
{
    use ImageManagement;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $is_small = $request->is_small;

        $skills = Skill::orderBy('name')->get();

        return view('projects.create', compact('is_small', 'skills'));
    }

    /**
     * Store a newly created resource in storage.
     *
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
            'is_small' => ['required', 'boolean'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['integer', 'exists:skills,id'],
        ]);

        $skillIds = $validated['skills'] ?? [];
        unset($validated['image_path'], $validated['skills']);

        $validated['image_path'] = $this->storeImage($request);
        $validated['slug'] = $this->uniqueSlug($validated['title']);

        Project::create($validated)->skills()->sync($skillIds);

        return redirect('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Project $project)
    {
        $skills = Skill::orderBy('name')->get();

        return view('projects.edit', compact('project', 'skills'));
    }

    /**
     * Update the specified resource in storage.
     *
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
            'is_small' => ['nullable', 'boolean'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['integer', 'exists:skills,id'],
        ]);

        $skillIds = $validated['skills'] ?? [];
        unset($validated['image_path'], $validated['skills']);

        if ($path = $this->storeImage($request)) {
            $this->deleteImage($project->image_path);
            $validated['image_path'] = $path;
        }

        if ($validated['title'] !== $project->title) {
            $validated['slug'] = $this->uniqueSlug($validated['title'], $project->id);
        }

        $project->update($validated);
        $project->skills()->sync($skillIds);

        return redirect('dashboard');
    }

    private function uniqueSlug(string $title, ?int $ignoreId = null): string
    {
        $base = Str::slug($title);
        $slug = $base;
        $i = 1;

        while (Project::where('slug', $slug)->when($ignoreId, fn ($query) => $query->where('id', '!=', $ignoreId))->exists()) {
            $slug = $base.'-'.$i++;
        }

        return $slug;
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Project $project)
    {
        $this->deleteImage($project->image_path);
        $project->delete();

        return back();
    }
}
