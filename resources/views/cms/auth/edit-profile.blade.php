@extends('cms.parent')

@section('title', 'Edit Profile')
@section('page-name', 'Edit Profile')
@section('main-page', 'Profile')
@section('sub-page', 'Edit Profile')

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
                            <h3 class="card-title">Edit Profile </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" id="create_form">
                            @csrf
                            @method('put')
                            <div class="card-body">
                                @if ($errors->any())
                                    <div class="alert alert-danger alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-ban"></i> Error!</h5>
                                        @foreach ($errors->all() as $error)
                                            <li>{{ $error }}</li>
                                        @endforeach
                                    </div>
                                @endif

                                @if (session()->has('message'))
                                    <div class="alert alert-success alert-dismissible">
                                        <button type="button" class="close" data-dismiss="alert"
                                            aria-hidden="true">×</button>
                                        <h5><i class="icon fas fa-check-circle"></i> {{ session('message') }}</h5>
                                    </div>
                                @endif


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
                                <button type="button" onclick="update(id)" class="btn btn-primary">update</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                @endsection

                @section('scripts')

                    <!-- bs-custom-file-input -->
                    <script src="{{ asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            bsCustomFileInput.init();
                        });

                    </script>


                    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
                    <!-- Toastr -->
                    <script src="{{ asset('cms/plugins/toastr/toastr.min.js') }}"></script>


                    <script>
                        function update(id) {
                            axios.put('/cms/admin/update-profile', {
                                    name: document.getElementById('name').value,
                                    city: document.getElementById('city').value,
                                    email: document.getElementById('email').value,
                                    phone: document.getElementById('phone').value,
                                    gender: document.getElementById('male').checked ? 'M' : 'F',

                                })
                                .then(function(response) {
                                    console.log(response);
                                    showToaster(response.data.message, true);
                                })
                                .catch(function(error) {
                                    console.log(error.response.data);
                                    showToaster(error.response.data.message, false);
                                });
                        }

                        function showToaster(message, status) {
                            if (status) {
                                toastr.success(message);
                            } else {
                                toastr.error(message);
                            }
                        }

                    </script>

                @endsection
