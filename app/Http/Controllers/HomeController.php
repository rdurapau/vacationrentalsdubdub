<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Spot;

class HomeController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home', [
            'spots' => [Spot::all()[0]],
        ]);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function map()
    {
        return view('map');
    }
}
