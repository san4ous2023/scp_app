<?php

namespace App\Http\Controllers\Photo;

use App\Http\Controllers\Controller;
use App\Models\hse\observations\Observation;
use App\Models\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DestroyController extends Controller
{

    public function __invoke(Photos $photo)
    {
        // Log the file path
        \Log::info('Attempting to delete file: ' . $photo->url);

        try {
            // Delete the file from storage
            if (Storage::disk('public')->exists($photo->url)) {
                Storage::disk('public')->delete($photo->url);
                \Log::info('File deleted successfully: ' . $photo->url);
            } else {
        \Log::warning('File not found: ' . $photo->url);
    }
            // Delete the database record
            $photo->delete();

            return redirect()
                ->back()
                ->with('success', 'Photo deleted successfully.');

        } catch (\Exception $e) {

            \Log::error('Error deleting photo: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to delete the photo. Please try again.');

        }

    }
}
