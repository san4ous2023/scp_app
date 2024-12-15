<?php

namespace App\Http\Controllers\Observation;

use App\Http\Controllers\Controller;

use App\Services\Observation\Service;
use Illuminate\Http\Request;

class BaseController extends Controller
{
    public $service;

    public function __construct(Service $service)
    {
        $this->service = $service;
    }
}
