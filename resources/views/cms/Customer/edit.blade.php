@extends('cms.parent')

@section('title', 'Edit Customer')
@section('page-name', 'Edit Customer')
@section('main-page', 'Customer')
@section('sub-page', 'Edit Customer')


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
                            <h3 class="card-title">Edit Customer </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('customer.update',$customer->id) }}">
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
                                    <label for="cus_name">Name</label>
                                    <input type="text" class="form-control" id="cus_name" name="cus_name"
                                        value="{{ $customer->cus_name }}" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="city">City</label>
                                    <input type="text" class="form-control" id="city" name="city"
                                        value="{{ $customer->city }}" placeholder="Enter city">
                                </div>
                                <div class="form-group">
                                    <label for="work">Work</label>
                                    <input type="text" class="form-control" id="work" name="work"
                                        value="{{ $customer->work }}" placeholder="Enter work">
                                </div>
                                <div class="form-group">
                                    <label for="email">Email</label>
                                    <input type="email" class="form-control" id="email" value="{{ $customer->email }}"
                                        name="email" placeholder="Enter email">
                                </div>
                                <div class="form-group">
                                    <label for="phone">Phone</label>
                                    <input type="text" class="form-control" id="phone" value="{{ $customer->phone }}"
                                        name="phone" placeholder="Enter phone">
                                </div>

                                <div class="form-group">
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="male" name="gender" @if ($customer->gender == 'M') checked @endif>
                                        <label for="male" class="custom-control-label">Male</label>
                                    </div>
                                    <div class="custom-control custom-radio">
                                        <input class="custom-control-input" type="radio" id="female" name="gender" @if ($customer->gender == 'F') checked @endif>
                                        <label for="female" class="custom-control-label">Female</label>
                                    </div>
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">update</button>
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

                @endsection
