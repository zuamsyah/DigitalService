<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\Index;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $testimonials = Testimonial::all();
        return view('index', compact('employees', 'testimonials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
     * @param  \App\Models\IndexController  $indexController
     * @return \Illuminate\Http\Response
     */
    public function show(IndexController $indexController)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\IndexController  $indexController
     * @return \Illuminate\Http\Response
     */
    public function edit(IndexController $indexController)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\IndexController  $indexController
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, IndexController $indexController)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\IndexController  $indexController
     * @return \Illuminate\Http\Response
     */
    public function destroy(IndexController $indexController)
    {
        //
    }
}
