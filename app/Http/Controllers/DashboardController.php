<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // In a real app, fetch statistics here. 
        // For now, we return the view which has placeholder visualizations.
        return view('welcome');
    }
}
