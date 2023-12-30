<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;
use App\Models\Department;
use App\Models\Status;
use App\Models\User;
use Illuminate\Http\Request;

class CreateController extends Controller
{
    public function __invoke(){


$departments = Department::all();
$statuses = Status::all();
$guestUser = User::first();
$user  = auth()->user()  ??  $guestUser;
return view('observation.create', compact('departments','user','statuses'));
    }
}
