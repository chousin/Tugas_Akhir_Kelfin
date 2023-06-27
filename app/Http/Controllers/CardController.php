<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CardController extends Controller
{
    public function index()
    {
        return view('components.card', [
            "title" => "Dashboard",
            "halaman" => "Home",
            "sub_hal" => "Dashboard"
        ]);
    }
}