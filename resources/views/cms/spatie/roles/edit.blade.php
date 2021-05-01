@extends('cms.parent')

@section('title', 'Edit Role')
@section('page-name', 'Edit Role')
@section('main-page', 'Roles')
@section('sub-page', 'Edit Role')

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
    <!-- Toastr -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/toastr/toastr.min.css') }}">
@endsection


@section('content')
    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        <div class="card-header">
                            <h3 class="card-title">Edit Roles </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form">
                            @csrf

                            <div class="card-body">

                                <div class="form-group">
                                    <label>Guards</label>
                                    <select class="form-control guards" id="guard" style="width: 100%;">
                                        <option value="admin" @if ($role->guard_name == 'admin') selected @endif>Admin</option>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="name">Role Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $role->name }}" placeholder="Enter Role Name">
                                </div>

                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="update({{ $role->id }})"
                                    class="btn btn-primary">update</button>
                            </div>

                        </form>
                    </div>
                    <!-- /.card -->
                @endsection

                @section('scripts')

                    <!-- Toastr -->
                    <script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>


                    <!-- bs-custom-file-input -->
                    <script src="{{ asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            bsCustomFileInput.init();
                        });

                    </script>

                    <script>
                        function update(id) {
                            // Make a request for a user with a given ID
                            axios.put('/cms/admin/roles/' + id, {
                                    guard: document.getElementById('guard').value,
                                    name: document.getElementById('name').value,
                                })
                                .then(function(response) {
                                    // handle success
                                    console.log(response);
                                    // document.getElementById("edit_form").reset();
                                    showtoster(true, response.data.message);
                                    window.location.href = '{{ route('roles.index') }}';
                                })
                                .catch(function(error) {
                                    // handle error
                                    console.log(error.response);
                                    showtoster(false, error.response.data.message);
                                });
                        }

                        function showtoster(status, message) {
                            if (status) {
                                toastr.success(message)
                            } else {
                                toastr.error(message)
                            }
                        }

                    </script>

                @endsection
