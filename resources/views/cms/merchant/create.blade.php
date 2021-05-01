@extends('cms.parent')

@section('title', 'Create Merchant')
@section('page-name', 'Create Merchant')
@section('main-page', 'Merchant')
@section('sub-page', 'Create Merchant')

@section('styles')
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
                            <h3 class="card-title">Create Merchant </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="create_form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="name">Name</label>
                                    <input type="text" class="form-control" id="name" name="name"
                                        value="{{ old('name') }}" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city') }}" placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="text" class="form-control" id="email" value="{{ old('email') }}"
                                        name="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" value="{{ old('phone') }}"
                                        name="phone" placeholder="Enter phone">
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="male" name="gender">
                                        <label for="male" class="custom-control-label">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="female" name="gender">
                                        <label for="female" class="custom-control-label">Female</label>
                                    </div>
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="button" onclick="store()" class="btn btn-primary">Submit</button>
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
                        function store() {
                            // Make a request for a user with a given ID
                            axios.post('/cms/admin/merchant', {
                                    name: document.getElementById('name').value,
                                    city: document.getElementById('city').value,
                                    email: document.getElementById('email').value,
                                    phone: document.getElementById('phone').value,
                                    gender: document.getElementById('male').checked ? 'M' : 'F',
                                })
                                .then(function(response) {
                                    // handle success
                                    console.log(response.data);
                                    document.getElementById("create_form").reset();
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
