<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

trait ImageManagement
{
    /**
     * Store the uploaded image and return its public path, or null when nothing was uploaded.
     */
    protected function storeImage(Request $request, string $field = 'image_path'): ?string
    {
        if (! $request->hasFile($field)) {
            return null;
        }

        return 'storage/'.$request->file($field)->store('images', 'public');
    }

    /**
     * Delete a stored image by its public path.
     */
    protected function deleteImage(?string $path): void
    {
        if ($path !== null) {
            Storage::disk('public')->delete(str_replace('storage/', '', $path));
        }
    }

    /**
     * Delete the image of the given model and clear its image_path.
     */
    protected function removeImage(Model $model): RedirectResponse
    {
        $this->deleteImage($model->image_path);
        $model->update(['image_path' => null]);

        return back();
    }
}
