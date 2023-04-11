@extends('admin.index')

@section('content')

<!-- Menampilkan Pesan Error -->
@if ($errors->any())
    <div class="alert alert-danger bg-danger text-light border-0 alert-dismissible fade show" role="alert" style="position: fixed; top: auto; right: 10px; z-index: 9999;">
        {{ $errors->first() }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<section class="section">
    <div class="row">
    <div class="col-lg-6 mx-auto">

        <div class="card">
        <div class="card-body">
            <h5 class="card-title">Create Employee</h5>

            <form action="{{ route('admin.employee.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row mb-3">
                <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                <div class="col-sm-10">
                <input type="text" name="name" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputPosition" class="col-sm-2 col-form-label">Position</label>
                <div class="col-sm-10">
                <input type="text" name="position" class="form-control">
                </div>
            </div>
            <div class="row mb-3">
                <label for="inputFileUpload" class="col-sm-2 col-form-label">Upload Profile</label>
                <div class="col-sm-10">
                <input class="form-control" type="file" name="file">
                </div>
            </div>

            <div class="row mb-3">
                <label class="col-sm-2 col-form-label"></label>
                <div class="col-sm-10">
                <button type="submit" class="btn btn-primary">Create</button>
                </div>
            </div>

            </form><!-- End General Form Elements -->

        </div>
        </div>

    </div>

    </div>
</section>
@endsection