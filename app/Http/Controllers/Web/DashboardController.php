<?php

namespace App\Http\Controllers\Web;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class DashboardController extends Controller
{
    
    public function index()
    {
        $title = 'Halaman Utama';
        return view('master.index')->with('title',$title);
    }
}
