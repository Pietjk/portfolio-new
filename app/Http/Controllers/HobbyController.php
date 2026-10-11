<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Traits\ImageManagement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HobbyController extends Controller
{
    use ImageManagement;

    public function create(): View
    {
        return view('hobbies.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($path = $this->storeImage($request)) {
            $validated['image_path'] = $path;
        }

        Hobby::create($validated);

        return redirect()->route('dashboard');
    }

    public function edit(Hobby $hobby): View
    {
        return view('hobbies.edit', compact('hobby'));
    }

    public function update(Request $request, Hobby $hobby): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($path = $this->storeImage($request)) {
            $this->deleteImage($hobby->image_path);
            $validated['image_path'] = $path;
        }

        $hobby->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroyImage(Hobby $hobby): RedirectResponse
    {
        return $this->removeImage($hobby);
    }

    public function destroy(Hobby $hobby): RedirectResponse
    {
        $hobby->hobbyPosts->each(fn ($post) => $this->deleteImage($post->image_path));
        $this->deleteImage($hobby->image_path);
        $hobby->delete();

        return back();
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'description' => ['required', 'string'],
            'icon' => ['nullable', 'string', 'max:255'],
            'image_path' => ['nullable', 'image', 'max:3000'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        unset($validated['image_path']);

        return $validated;
    }
}
