@extends('cms.parent')

@section('title', 'Edit Car')
@section('page-name', 'Edit Car')
@section('main-page', 'Car')
@section('sub-page', 'Edit Car')


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
                            <h3 class="card-title">Create Car </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('car.update', $car->id) }}">
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
                                    <label for="car_name">Name</label>
                                    <input type="text" class="form-control" id="car_name" name="car_name"
                                        value="{{ $car->car_name }}" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        value="{{ $car->price }}" placeholder="Enter price">
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" id="type" value="{{ $car->type }}" name="type"
                                        placeholder="Enter type">
                                </div>
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" id="model" value="{{ $car->model }}"
                                        name="model" placeholder="Enter model">
                                </div>

                                <div class="form-group">
                                    <label for="sour_car">Sour_car</label>
                                    <input type="text" class="form-control" id="sour_car" value="{{ $car->sour_car }}"
                                        name="sour_car" placeholder="Enter sour_car">
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
