<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\hse\observations\Observation;
use Illuminate\Http\Request;

class DestroyController extends BaseController
{
    public function __invoke(Observation $observation)
    {
        $observation->delete();
        session()->flash('success', 'Observation was deleted successfully.');
        return redirect()->route('observation.index');
// $post = Post::findOrFail($id);
       // return view('observation.show', compact('observation'));
    }
}
