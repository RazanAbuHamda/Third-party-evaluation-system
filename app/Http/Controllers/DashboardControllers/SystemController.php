<?php

namespace App\Http\Controllers\DashboardControllers;

use App\Http\Controllers\Controller;

class SystemController extends Controller
{
    public function index()
    {
        return view('dashboard-views.index');
    }
}
