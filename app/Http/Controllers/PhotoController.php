<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\Request;

class PhotoController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('photos.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $path = request()->file('photo')->store('sp','s3');
        $spot = \App\Spot::first();
        $spot
            ->addMedia(request()->file('photo'))
            ->toMediaCollection();
        // return Storage::disk('s3')->url('sp/9XbELFfGYmMdEet2cIwIBt4PkDvWGg56TI2Ba2zW.jpeg');
        // Storage::disk('s3')->put('/sp/hello.txt','World');
    }
}
