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
       // echo($photo->url);
        try {
          //  dd(Storage::exists($photo->url), $photo->url, $photo);
            // Delete the file from storage
            if (Storage::exists($photo->url)) {
                Storage::delete($photo->url);

                // Delete the photo record from the database
               // $photo->delete();
            }
            // Delete the database record
            $photo->delete();

            return redirect()
                ->back()
                ->with('success', 'Photo deleted successfully.');

       // else response()->json(['not success' => true], 200);

            //echo('url no exist');
        } catch (\Exception $e) {
           // echo('error');
            //var_dump($e->getMessage());
            // Log the error for debugging
            \Log::error('Error deleting photo: ' . $e->getMessage());
            return redirect()
                ->back()
                ->with('error', 'Failed to delete the photo. Please try again.');
            //return response()->json(['error' => 'Failed to delete photo'], 500);
        }

       // echo('done');
//// Delete the file from storage
//        if (Storage::exists($photo->url)) {
//            //dd($photo->url);
//            Storage::delete($photo->url);
//        }
//
//        // Remove the photo record from the database
//        $photo->delete();
//        //dd('deleted');
//        // Redirect back with success message
//        return redirect()->route('observation.index')->with('success', 'Photo deleted successfully.');
    }
}
