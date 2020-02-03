<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Spot;

class AppController extends Controller
{
    /**
     * Show the app
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('app');
    }

}
