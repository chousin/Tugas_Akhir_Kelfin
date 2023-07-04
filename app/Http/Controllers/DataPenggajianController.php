<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DataPenggajianController extends Controller
{
    public function index()
    {
        return view('penggajian.index', [
            'title' => 'Data Penggajian',
            'halaman' => 'Home',
            'sub_hal' => 'Data Penggajian',
        ]);
    }
}
