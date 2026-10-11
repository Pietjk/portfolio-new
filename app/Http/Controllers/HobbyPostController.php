<?php

namespace App\Http\Controllers;

use App\Models\Hobby;
use App\Models\HobbyPost;
use App\Traits\ImageManagement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HobbyPostController extends Controller
{
    use ImageManagement;

    public function create(): View
    {
        $hobbies = Hobby::all();

        return view('hobby_posts.create', compact('hobbies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($path = $this->storeImage($request)) {
            $validated['image_path'] = $path;
        }

        HobbyPost::create($validated);

        return redirect()->route('dashboard');
    }

    public function edit(HobbyPost $hobbyPost): View
    {
        $hobbies = Hobby::all();

        return view('hobby_posts.edit', compact('hobbyPost', 'hobbies'));
    }

    public function update(Request $request, HobbyPost $hobbyPost): RedirectResponse
    {
        $validated = $this->validated($request);

        if ($path = $this->storeImage($request)) {
            $this->deleteImage($hobbyPost->image_path);
            $validated['image_path'] = $path;
        }

        $hobbyPost->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroyImage(HobbyPost $hobbyPost): RedirectResponse
    {
        return $this->removeImage($hobbyPost);
    }

    public function destroy(HobbyPost $hobbyPost): RedirectResponse
    {
        $this->deleteImage($hobbyPost->image_path);
        $hobbyPost->delete();

        return back();
    }

    /**
     * @return array<string, mixed>
     */
    private function validated(Request $request): array
    {
        $validated = $request->validate([
            'hobby_id' => ['required', 'exists:hobbies,id'],
            'name' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string'],
            'image_path' => ['nullable', 'image', 'max:5000'],
            'link' => ['nullable', 'url', 'max:255'],
        ]);

        unset($validated['image_path']);

        return $validated;
    }
}
