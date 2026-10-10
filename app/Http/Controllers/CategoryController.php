<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class CategoryController extends Controller
{
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

        if ($request->hasFile('image_path')) {
            $validated['image_path'] = 'storage/'.$request->file('image_path')->store('images', 'public');
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

        if ($request->hasFile('image_path')) {
            $this->deleteImage($category->image_path);
            $validated['image_path'] = 'storage/'.$request->file('image_path')->store('images', 'public');
        }

        $category->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroy(Category $category): RedirectResponse
    {
        $category->skills->each(fn ($skill) => $this->deleteImage($skill->image_path));
        $this->deleteImage($category->image_path);
        $category->delete();

        return back();
    }

    private function deleteImage(?string $path): void
    {
        if ($path !== null) {
            Storage::disk('public')->delete(str_replace('storage/', '', $path));
        }
    }
}
