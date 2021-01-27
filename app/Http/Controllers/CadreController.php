<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CadreController extends Controller
{
     /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:cadre');
    }
    public function index()
    {
        return view('cadre.index');
    }
}
