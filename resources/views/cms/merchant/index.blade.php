@extends('cms.parent')

@section('title', 'Index Merchant')
@section('page-name', 'Index Merchant')
@section('main-page', 'Merchant')
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
                                        <th>ID</th>
                                        <th>Name</th>
                                        <th>City</th>
                                        <th>Email</th>
                                        <th>Phone</th>
                                        <th>Gender</th>
                                        <th>Permissions</th>
                                        <th>Car Count</th>
                                        <th>Created_at</th>
                                        <th>Updated_at</th>
                                        <th>Setting</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($merchants as $merchant)
                                        <tr>
                                            <td>{{ $merchant->id }}</td>
                                            <td>{{ $merchant->name }}</td>
                                            <td>{{ $merchant->city }}</td>
                                            <td>{{ $merchant->email }}</td>
                                            <td>{{ $merchant->phone }}</td>
                                            <td>{{ $merchant->gender }}</td>
                                            <td><a href="{{ route('merchants.permissions.index', $merchant->id) }}"
                                                    class="btn btn-info">{{ $merchant->permissions_count }}/Permissions<i
                                                        class="fas fa-user-tie"></i>
                                                </a></td>
                                            <td><span class="badge bg-info">{{ $merchant->car_count }} Car/s</span></td>
                                            <td>{{ $merchant->created_at }}</td>
                                            <td>{{ $merchant->updated_at }}</td>
                                            <td>
                                                <div class="btn-group">
                                                    @can('Update-Merchants')
                                                        <a href="{{ route('merchant.edit', $merchant->id) }}" type="button"
                                                            class="btn btn-info">
                                                            <i class="fas fa-edit" aria-hidden="true">Edit</i>
                                                        </a>
                                                    @endcan

                                                    @if (Auth::user()->id !== $merchant->id)
                                                        @can('Delete-Merchants')
                                                            <a href="#" class="btn btn-danger"
                                                                onclick="confirmDestroy({{ $merchant->id }},this)">
                                                                <i class="fas fa-trash"> Delete</i>
                                                            </a>
                                                        @endcan
                                                    @endif
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer clearfix">
                            {{-- {{ $merchants->render() }} --}}

                            {{ $merchants->links() }}


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
            axios.delete('/cms/admin/merchant/' + id)
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
