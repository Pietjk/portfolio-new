<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Traits\ImageManagement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CategoryController extends Controller
{
    use ImageManagement;

    public function create(): View
    {
        return view('categories.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'image', 'max:3000'],
        ]);

        unset($validated['image_path']);

        if ($path = $this->storeImage($request)) {
            $validated['image_path'] = $path;
        }

        Category::create($validated);

        return redirect()->route('dashboard');
    }

    public function edit(Category $category): View
    {
        return view('categories.edit', compact('category'));
    }

    public function update(Request $request, Category $category): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'image', 'max:3000'],
        ]);

        unset($validated['image_path']);

        if ($path = $this->storeImage($request)) {
            $this->deleteImage($category->image_path);
            $validated['image_path'] = $path;
        }

        $category->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroyImage(Category $category): RedirectResponse
    {
        return $this->removeImage($category);
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->skills->each(fn ($skill) => $this->deleteImage($skill->image_path));
        $this->deleteImage($category->image_path);
        $category->delete();

        return back();
    }
}
