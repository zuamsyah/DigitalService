@extends('admin.index')

@section('content')
<div class="pagetitle">
    <h1>Employee</h1>
    <nav>
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item active">Employee</li>
    </ol>
    </nav>
</div><!-- End Page Title -->

<section class="section">
    <div class="row">
    <div class="col-lg-12">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Datatables</h5>

            <!-- Table with stripped rows -->
            <table id="employee" class="table datatable">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Profile</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                </tr>
            </thead>
            <tbody>
            @php
                $no = 1;
            @endphp
                @foreach($employees as $key => $employee)
                <tr>
                    <th scope="row">{{ $no }}</th>
                    <td>{{ $employee->name }}</td>
                    <td>{{ $employee->position }}</td>
                    <td>{{ $employee->profile }}</td>
                    <td>{{ $employee->created_at }}</td>
                    <td>{{ $employee->updated_at }}</td>
                </tr>
                @php
                    $no++
                @endphp
                @endforeach
            </tbody>
            </table>
            <!-- End Table with stripped rows -->

        </div>
        </div>

    </div>
    </div>
</section>
@endsection
