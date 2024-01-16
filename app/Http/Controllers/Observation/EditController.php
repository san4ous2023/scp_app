<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\hse\observations\Observation;
use Illuminate\Http\Request;

class EditController extends Controller
{
    public function __invoke(Observation $observation)
    {
// $post = Post::findOrFail($id);
        // return view('observation.show', compact('observation'));
    }
}
