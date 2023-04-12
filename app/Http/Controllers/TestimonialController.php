<?php

namespace App\Http\Controllers;

use App\Models\Testimonial;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class TestimonialController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.testimonial.index');
    }

    public function datatable()
    {
        $allTestimonial = Testimonial::all();

        $month = [
            'Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        return DataTables::of($allTestimonial)
            ->addIndexColumn()
            ->editColumn('created_at', function ($employee) use ($month) {
                $createdAt = Carbon::parse($employee->created_at);
                return $createdAt->format('j').' '.$month[$createdAt->month - 1].' '.$createdAt->year.' '.$createdAt->format('H:i:s');
            })
            ->editColumn('updated_at', function ($employee) use ($month) {
                $updatedAt = Carbon::parse($employee->updated_at);
                return $updatedAt->format('j').' '.$month[$updatedAt->month - 1].' '.$updatedAt->year.' '.$updatedAt->format('H:i:s');
            })
            ->addColumn('action', function($row){
                $btn = '<a href="/admin/testimonial/edit/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a>';
                $btn = $btn.' <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';
                return $btn;
             })
            ->rawColumns(['name', 'position', 'message', 'action'])
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.testimonial.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required|string',
            'message' => 'required|string',
        ]);

        $create = [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'message' => $request->input('message'),
        ];

        Testimonial::create($create);
        
        return redirect()->route('admin.testimonial')->with('success', 'Testimonial successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function show(Testimonial $testimonial)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function edit(Testimonial $testimonial)
    {
        return view('admin.testimonial.edit', compact('testimonial'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Testimonial $testimonial)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required|string',
            'message' => 'required|string',
        ]);

        $edit = [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
            'message' => $request->input('message'),
        ];

        $testimonial->update($edit);

        return redirect()->route('admin.testimonial')->with('success', 'Testimonial successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Testimonial  $testimonial
     * @return \Illuminate\Http\Response
     */
    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();

        return redirect()->route('admin.testimonial')->with('success', 'Testimonial successfully deleted');
    }
}
