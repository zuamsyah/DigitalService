@extends('admin.index')

@section('content')
<!-- Menampilkan Pesan Sukses -->
@if(session('success'))
    <div class="alert alert-primary bg-primary text-light border-0 alert-dismissible fade show" role="alert" style="position: fixed; top: 70px; right: 10px; z-index: 9999;">
        {{ session('success') }}
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>

    <script>
        setTimeout(function(){
            $('.alert').alert('close');
        }, 5000);
    </script>
@endif

<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete Confirmation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            Are you sure you want to delete this data?
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <form id="deleteForm" method="POST">
                @csrf
                @method('delete')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
        </div>
        </div>
    </div>
</div>

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
            <h5 class="card-title">Employees</h5>
            <a href="{{ route('admin.employee.create') }}" class="btn btn-success" style="position: absolute; top: 0; right: 15px; margin: 15px;"><i class="bi bi-plus-square"></i> Add</a>

            <!-- Table with stripped rows -->
            <table id="employee" class="table">
            <thead>
                <tr>
                <th scope="col">No</th>
                <th scope="col">Name</th>
                <th scope="col">Position</th>
                <th scope="col">Profile</th>
                <th scope="col">Created At</th>
                <th scope="col">Updated At</th>
                <th scope="col" width="150px">Action</th>
                </tr>
            </thead>
            </table>
            <!-- End Table with stripped rows -->

        </div>
        </div>

    </div>
    </div>
</section>
@endsection

@push('js')
    <script>
        $(document).ready(function() {
            $('#employee').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('admin.employee.datatable') }}",
                columns: [
                    {data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false},
                    {data: 'name', name: 'name'},
                    {data: 'position', name: 'position'},
                    {
                        data: 'profile_url', 
                        name: 'profile_url', 
                        render: function (data, type, row, meta) {
                            return '<a href="#"><img src="' + data + '" alt="" class="img-fluid"></a>'; 
                        },
                    },
                    {data: 'created_at', name: 'created_at'},
                    {data: 'updated_at', name: 'updated_at'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

            $('#deleteModal').on('show.bs.modal', function (event) {
                var button = $(event.relatedTarget);
                var id = button.data('id');
                var url = '/admin/employee/' + id;
                $('#deleteForm').attr('action', url);
            });
        });
    </script>
@endpush