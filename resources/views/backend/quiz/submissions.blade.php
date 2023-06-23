@extends('backend.layout.layout')
@section('title','Daily Quiz')
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
                        <h1>Submissions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Submissions</li>
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
                                <a href="{{ route('quiz.index') }}">
                                    <button class="btn btn-primary">Back</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Quiz Name</th>
                                            <th>Quiz Conducted on</th>
                                            <th>Submitted By</th>
                                            <th>Submitted at</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key => $item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->quiz->quiz_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->quiz->start_date)->format('d-m-Y') }}</td>
                                                <td>{{ $item->user->name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y H:s') }}</td>
                                                <td>
                                                    <a href="{{ route('admin.quizResult', ['quizId' => $item->quiz->id, 'userId' => $item->user->id]) }}">
                                                        <button class="btn btn-success">Result</button>
                                                    </a>
                                                </td>
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
