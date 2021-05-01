@extends('cms.parent')

@section('title', 'Edit Merchant')
@section('page-name', 'Edit Merchant')
@section('main-page', 'Merchant')
@section('sub-page', 'Edit Merchant')

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
                            <h3 class="card-title">Edit Merchant </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form">
                            @csrf

                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ $merchant->name }}" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ $merchant->city }}" placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" value="{{ $merchant->email }}"
                                        name="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" value="{{ $merchant->phone }}"
                                        name="phone" placeholder="Enter phone">
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="male" name="gender" @if ($merchant->gender == 'M') checked @endif>
                                        <label for="male" class="custom-control-label">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="female" name="gender" @if ($merchant->gender == 'F') checked @endif>
                                        <label for="female" class="custom-control-label">Female</label>
                                    </div>
                                </div>


                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="update({{ $merchant->id }})"
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
                            axios.put('/cms/admin/merchant/' + id, {
                                    name: document.getElementById('name').value,
                                    city: document.getElementById('city').value,
                                    email: document.getElementById('email').value,
                                    phone: document.getElementById('phone').value,
                                    gender: document.getElementById('male').checked ? 'M' : 'F',
                                })
                                .then(function(response) {
                                    // handle success
                                    console.log(response);
                                    // document.getElementById("edit_form").reset();
                                    showtoster(true, response.data.message);
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
