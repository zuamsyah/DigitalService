<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use Illuminate\Http\Request;
use Yajra\DataTables\DataTables;
use Carbon\Carbon;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::get()->all();
        return view('admin.employee.index', compact('employees'));
    }

    public function datatable()
    {
        $allEmployee = Employee::all();

        $month = [
            'Januari', 'Febuari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',
        ];

        return DataTables::of($allEmployee)
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
                $btn = '<a href="/admin/employee/edit/'.$row->id.'" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editPost">Edit</a>';
                $btn = $btn.' <a href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deletePost">Delete</a>';
                return $btn;
             })
            ->make(true);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.employee.create');
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
            'file' => 'required|mimes:jpg,jpeg,png|max:2048',
        ]);

        $create = [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);

            $create['profile_url'] = '/uploads/' . $fileName;
        }

        Employee::create($create);
        
        return redirect()->route('admin.employee')->with('success', 'Employee successfully created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit(Employee $employee)
    {
        $employee = Employee::findOrFail($employee->id);
        return view('admin.employee.edit', compact('employee'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Employee $employee)
    {
        $request->validate([
            'name' => 'required',
            'position' => 'required|string',
            'file' => 'nullable|mimes:jpg,jpeg,png|max:2048',
        ]);

        $edit = [
            'name' => $request->input('name'),
            'position' => $request->input('position'),
        ];

        if ($request->hasFile('file')) {
            $file = $request->file('file');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('uploads'), $fileName);

            $edit['profile_url'] = '/uploads/' . $fileName;
        }

        $employee->update($edit);

        return redirect()->route('admin.employee')->with('success', 'Employee successfully updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        Employee::where('id', $employee->id)->delete();

        return redirect()->route('admin.employee')->with('success', 'Employee successfully deleted');
    }
}
