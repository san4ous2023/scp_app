<?php

namespace App\Http\Controllers\Photo;

use App\Http\Controllers\Controller;
use App\Models\Photos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class BulkDestroyController extends Controller
{
    public function __invoke(Request $request)
    {
        dd('hi');
        $photoIds = $request->input('photo_ids', []); // Retrieve selected photo IDs

        if (empty($photoIds)) {
            return redirect()->back()->with('error', 'No photos selected for deletion.');
        }

// Delete photos from storage and database
        $photos = Photos::whereIn('id', $photoIds)->get();
        foreach ($photos as $photo) {
            Storage::delete($photo->url); // Delete from storage
            $photo->delete(); // Delete record
        }

        return redirect()->back()->with('success', 'Selected photos deleted successfully.');
    }
}
