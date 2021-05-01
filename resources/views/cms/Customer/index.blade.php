@extends('cms.parent')

@section('title', 'Index Customer')
@section('page-name', 'Index Customer')
@section('main-page', 'Customer')
@section('sub-page', 'Index')

@section('styles')
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet">
@endsection

@section('content')
    <section class="content">
        <div class="container-fluid">
            <!-- /.row -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-header">
                            <h3 class="card-title">Data Merchant</h3>
                            <div class="card-tools">
                                <div class="input-group input-group-sm" style="width: 150px;">
                                    <input type="text" name="table_search" class="form-control float-right"
                                        placeholder="Search">

                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-default"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body table-responsive p-0">
                            <table class="table table-hover text-nowrap table-bordered">
                                <thead>
                                    <tr>
                                        <th>img</th>
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>Work</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($customers as $index => $customer)
                                        <tr class="intro-x">
                                            <td>
                                                {{-- src="{{ asset('cms/dist/img/user1-128x128.jpg') }}" --}}
                                                <div class="w-10 h-10 image-fit zoom-in">
                                                    <img alt="x " src="{{ asset('images/customer/' . $customer->image) }}"
                                                        title="Uploded at 17">
                                                </div>
                                            </td>

                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $customer->cus_name }}</td>
                                            <td>{{ $customer->city }}</td>
                                            <td>{{ $customer->work }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->phone }}</td>
                                            <td>{{ $customer->gender }}</td>
                                            <td>{{ $customer->created_at }}</td>
                                            <td>{{ $customer->updated_at }}</td>

                                            <td>
                                                <div class="btn-group">
                                                    {{-- @can('Updata-Customers') --}}
                                                    <a href="{{ route('customer.edit', $customer->id) }}" type="button"
                                                        class="btn btn-info">
                                                        <i class="fas fa-edit" aria-hidden="true">Edit</i>
                                                    </a>
                                                    {{-- @endcan --}}
                                                    {{-- @can('Delete-Customers') --}}
                                                    <a href="#" class="btn btn-danger"
                                                        onclick="confirmDestroy({{ $customer->id }},this)">
                                                        <i class="fas fa-trash"> Delete</i>
                                                    </a>
                                                    {{-- @endcan --}}
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{-- {{ $merchants->render() }} --}}

                            {{ $customers->links() }}


                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection

@section('scripts')
    <script>
        function confirmDestroy(id, td) {

            // alert("delete:" + id);
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    destroy(id, td);
                }
            })
        }

        function destroy(id, td) {
            axios.delete('/cms/admin/customer/' + id)
                .then(function(response) {
                    // handle success
                    console.log(response.data);
                    td.closest('tr').remove();
                    showAlert(response.data);
                })
                .catch(function(error) {
                    // handle error
                    console.log(error);
                    console.log(error.response);
                    showAlert(error.response.data);
                })
                .then(function() {
                    // always executed
                });
        }

        function showAlert(data) {
            Swal.fire({
                title: data.title,
                text: data.message,
                icon: data.icon,
                timer: 1500,
                showConfirmButton: false,
                timerProgressBar: false,
                didOpen: () => {
                    Swal.showLoading()
                },
                willClose: () => {

                }
            }).then((result) => {
                /* Read more about handling dismissals below */
                if (result.dismiss === Swal.DismissReason.timer) {
                    console.log('I was closed by the timer')
                }
            })
        }

    </script>

@endsection
