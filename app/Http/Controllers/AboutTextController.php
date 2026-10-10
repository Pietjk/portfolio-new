<?php

namespace App\Http\Controllers;

use App\Models\AboutText;
use App\Traits\ImageManagement;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class AboutTextController extends Controller
{
    use ImageManagement;

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.create');
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
            'subtitle' => ['nullable', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'image_path' => ['nullable', 'image', 'max:3000'],
        ]);

        unset($validated['image_path']);

        if ($path = $this->storeImage($request)) {
            $validated['image_path'] = $path;
        }

        AboutText::create($validated);

        return redirect('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutText $aboutText)
    {
        return view('about.edit', compact('aboutText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutText $aboutText)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'subtitle' => ['nullable', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'image_path' => ['nullable', 'image', 'max:3000'],
        ]);

        unset($validated['image_path']);

        if ($path = $this->storeImage($request)) {
            $this->deleteImage($aboutText->image_path);
            $validated['image_path'] = $path;
        }

        $aboutText->update($validated);

        return redirect('dashboard');
    }

    /**
     * Remove the uploaded image of the specified resource.
     */
    public function destroyImage(AboutText $aboutText): RedirectResponse
    {
        return $this->removeImage($aboutText);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutText $aboutText)
    {
        $this->deleteImage($aboutText->image_path);
        $aboutText->delete();

        return back();
    }
}
