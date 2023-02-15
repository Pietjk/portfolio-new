<?php

namespace App\Http\Controllers;

use App\Models\AboutText;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class
AboutTextController extends Controller
{
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
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

        AboutText::create($validated);

        return redirect('dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutText  $aboutText
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutText $aboutText)
    {
        return view('about.edit', compact('aboutText'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutText  $aboutText
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutText $aboutText)
    {
        $validated = $request->validate([
            'title' => ['required', 'string', 'min:3'],
            'subtitle' => ['nullable', 'string', 'min:3'],
            'text' => ['required', 'string', 'min:3'],
            'image_path' => ['nullable', 'image', 'max:3000']
        ]);

        unset($validated['image_path']);

        if ($request->file('image_path') !== null) {
            $image_path = str_replace('storage/', '', $aboutText->image_path);
            Storage::disk('public')->delete($image_path);

            $path = $request->file('image_path')->store(
                'images',
                'public'
            );

            $validated['image_path'] = 'storage/'.$path;
        }

        $aboutText->update($validated);

        return redirect('dashboard');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutText  $aboutText
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutText $aboutText)
    {
        $image = str_replace('storage/', '', $aboutText->image_path);
        Storage::disk('public')->delete($image);
        $aboutText->delete();
        return back();
    }
}
