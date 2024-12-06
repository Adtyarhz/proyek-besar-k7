<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MbkmController extends Controller
{
    /**
     * Display the Informasi MBKM page.
     */
    public function informasi()
    {
        return view('app.mahasiswa.home_mbkm');
    }
}
