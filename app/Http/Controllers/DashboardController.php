<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('layouts.main', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Dashboard"
        ]);
    }
}