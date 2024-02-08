<?php

namespace App\Http\Controllers;

use App\Models\Cause;
use App\Http\Requests\StoreCauseRequest;
use App\Http\Requests\UpdateCauseRequest;

class CauseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('home');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cause.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCauseRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Cause $cause)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cause $cause)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCauseRequest $request, Cause $cause)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cause $cause)
    {
        //
    }
}
