<?php

namespace App\Http\Controllers\Respo;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Demande;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('respo.index');
    }
}
