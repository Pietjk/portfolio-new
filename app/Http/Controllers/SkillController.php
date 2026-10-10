<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Skill;
use App\Traits\ImageManagement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class SkillController extends Controller
{
    use ImageManagement;

    public function create(): View
    {
        $categories = Category::all();

        return view('skills.create', compact('categories'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'image', 'max:3000'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        unset($validated['image_path']);

        if ($path = $this->storeImage($request)) {
            $validated['image_path'] = $path;
        }

        Skill::create($validated);

        return redirect()->route('dashboard');
    }

    public function edit(Skill $skill): View
    {
        $categories = Category::all();

        return view('skills.edit', compact('skill', 'categories'));
    }

    public function update(Request $request, Skill $skill): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'image', 'max:3000'],
            'category_id' => ['required', 'exists:categories,id'],
        ]);

        unset($validated['image_path']);

        if ($path = $this->storeImage($request)) {
            $this->deleteImage($skill->image_path);
            $validated['image_path'] = $path;
        }

        $skill->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroyImage(Skill $skill): RedirectResponse
    {
        return $this->removeImage($skill);
    }

    public function destroy(Skill $skill): RedirectResponse
    {
        $this->deleteImage($skill->image_path);
        $skill->delete();

        return back();
    }
}
