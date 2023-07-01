@extends('backend.layout.layout')
@section('title','Niyam')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Niyam</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Niyam</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-header">
                                <div class="d-flex justify-content-left">
                                    <a href="{{ route('niyam.add') }}">
                                        <button class="btn btn-primary mx-1">Add Niyam</button>
                                    </a>
                                    <a href="{{ route('admin.niyamSubmissions') }}">
                                        <button class="btn btn-primary mx-1">View Submissions</button>
                                    </a>
                                    <a href="{{ route('admin.niyam.generateResult') }}">
                                        <button class="btn btn-primary mx-1">Show Overall Result</button>
                                    </a>
                                </div>
                                
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th style="width: 10%">S.No</th>
                                            <th>Niyam</th>
                                            {{-- <th>Action</th> --}}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($data as $key=>$item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->niyam_name }}</td>
                                                {{-- <td>
                                                    <a href="{{ route('niyam.delete', ['id' => $item->id]) }}">
                                                        <button class="btn btn-danger">Delete</button>
                                                    </a>
                                                </td> --}}
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col -->
                </div>
                <!-- /.row -->
            </div>
            <!-- /.container-fluid -->
        </section>
    </div>
@endsection
@section('script')
    <script src="https://cdn.datatables.net/1.13.2/js/jquery.dataTables.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#example').DataTable();
        });

        function saveSwitchState(checkbox) 
        {
            var switchState = checkbox.checked ? 1 : 0 ; // Get the state of the switch button
            var itemId = checkbox.id.replace("quiz", ""); // Extract the item ID from the checkbox ID

            // Get the CSRF token value from the meta tag in your HTML
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');


             // Include the CSRF token in the AJAX headers
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                }
            });

            $.ajax({
                url: "{{ route('quiz.changeStatus') }}",
                type: "POST",
                data: {
                    switchState: switchState,
                    itemId: itemId
                },
                success: function(response) {
                    // Handle the response from the server if needed
                    console.log(response);
                },
                error: function(xhr, status, error) {
                    // Handle errors if any
                    console.error(error);
                }
            });
        }

    </script>
@endsection
