<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserDashboardController extends Controller
{
    // Dashboard index method
    public function index()
    {
        // Pass any data if needed. For now, just return a simple view
        return view('user.dashboard');
    }
}
