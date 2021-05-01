@extends('cms.parent')

@section('title', 'Create Customer')
@section('page-name', 'Create Customer')
@section('main-page', 'Customer')
@section('sub-page', 'Create Customer')
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
                            <h3 class="card-title">Create Customer </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        {{-- enctype="multipart/form-data" --}}
                        <form role="form" id="create_form">
                            @csrf
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="cus_name">Name</label>
                                    <input type="text" class="form-control" id="cus_name" name="cus_name"
                                        value="{{ old('cus_name') }}" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ old('city') }}" placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <label for="work">Work</label>
                                    <input type="text" class="form-control" id="work" name="work"
                                        value="{{ old('work') }}" placeholder="Enter work">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ old('email') }}"
                                        name="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" value="{{ old('phone') }}"
                                        name="phone" placeholder="Enter phone">
                                </div>

                                <div class="form-group">
                                    <label for="exampleInputFile">img file</label>
                                    <div class="input-group">
                                        <div class="custom-file">
                                            <input type="file" class="form-control" id="exampleInputFile" name="admin_image"
                                                accept="image/*">
                                            {{-- <input class="form-control" type="file" name="admin_image" accept="image/*"> --}}
                                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                                        </div>
                                    </div>
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
                            axios.post('/cms/admin/customer', {
                                    cus_name: document.getElementById('cus_name').value,
                                    city: document.getElementById('city').value,
                                    work: document.getElementById('work').value,
                                    email: document.getElementById('email').value,
                                    phone: document.getElementById('phone').value,
                                    male: document.getElementById('male').value,
                                    female: document.getElementById('female').value,
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
