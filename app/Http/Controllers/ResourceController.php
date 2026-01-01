<?php

namespace App\Http\Controllers;

use App\Models\MentalHealthResource;
use Illuminate\Http\Request;

class ResourceController extends Controller
{
    public function index()
    {
        $resources = MentalHealthResource::all();
        return view('resources.index', compact('resources'));
    }
}
