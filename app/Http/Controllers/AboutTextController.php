<?php

namespace App\Http\Controllers;

use App\Models\AboutText;
use Illuminate\Http\Request;

class 
AboutTextController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('about.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AboutText  $aboutText
     * @return \Illuminate\Http\Response
     */
    public function show(AboutText $aboutText)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AboutText  $aboutText
     * @return \Illuminate\Http\Response
     */
    public function edit(AboutText $aboutText)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AboutText  $aboutText
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, AboutText $aboutText)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AboutText  $aboutText
     * @return \Illuminate\Http\Response
     */
    public function destroy(AboutText $aboutText)
    {
        //
    }
}
