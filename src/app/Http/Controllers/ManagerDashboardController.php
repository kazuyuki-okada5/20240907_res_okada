<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ManagerDashboardController extends Controller
{
    public function index()
    {
        $representatives = Representative::all();
        return view('manager.dashboard', compact('representatives'));
    }
}
