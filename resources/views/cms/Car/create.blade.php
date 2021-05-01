@extends('cms.parent')

@section('title', 'Create Car')
@section('page-name', 'Create Car')
@section('main-page', 'Car')
@section('sub-page', 'Create Car')

@section('styles')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ asset('cms/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ asset('cms/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
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
                            <h3 class="card-title">Create Car </h3>
                        </div>
                        <!-- /.card-header -->
                        <!-- form start -->
                        <form role="form" method="POST" action="{{ route('car.store') }}">
                            @csrf
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
                                    <label>Merchant</label>
                                    <select class="form-control select2" style="width: 100%;">
                                        @foreach ($merchants as $merchant)
                                            <option value="{{ $merchant->id }}">{{ $merchant->name }}</option>
                                        @endforeach
                                    </select>
                                </div>	

                                <div class="form-group">
                                    <label for="car_name">Name</label>
                                    <input type="text" class="form-control" id="car_name" name="car_name"
                                        value="{{ old('car_name') }}" placeholder="Enter name">
                                </div>
                                <div class="form-group">
                                    <label for="price">Price</label>
                                    <input type="text" class="form-control" id="price" name="price"
                                        value="{{ old('price') }}" placeholder="Enter price">
                                </div>
                                <div class="form-group">
                                    <label for="type">Type</label>
                                    <input type="text" class="form-control" id="type" value="{{ old('type') }}"
                                        name="type" placeholder="Enter type">
                                </div>
                                <div class="form-group">
                                    <label for="model">Model</label>
                                    <input type="text" class="form-control" id="model" value="{{ old('model') }}"
                                        name="model" placeholder="Enter model">
                                </div>

                                <div class="form-group">
                                    <label for="sour_car">Sour_car</label>
                                    <input type="text" class="form-control" id="sour_car" value="{{ old('sour_car') }}"
                                        name="sour_car" placeholder="Enter sour_car">
                                </div>



                            </div>
                            <!-- /.card-body -->

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary">Submit</button>
                            </div>
                        </form>
                    </div>
                    <!-- /.card -->
                @endsection

                @section('scripts')

                    <!-- Select2 -->
                    <script src="{{ asset('cms/plugins/select2/js/select2.full.min.js') }}"></script>

                    <!-- bs-custom-file-input -->
                    <script src="{{ asset('cms/plugins/bs-custom-file-input/bs-custom-file-input.min.js') }}"></script>

                    <script type="text/javascript">
                        $(document).ready(function() {
                            bsCustomFileInput.init();
                        });

                    </script>

                    <script>
                        $(function() {

                            //Initialize Select2 Elements
                            $('.select2').select2({
                                theme: 'bootstrap4'
                            })

                        })

                    </script>
                @endsection
