@extends('frontend.layout.layout')
@section('title','Niyam Submissions')
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
                        <h1>Niyam Submissions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Niyam Submissions</li>
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
                            <div class="card-header">
                                <a href="{{ route('user.niyam.index') }}">
                                    <button class="btn btn-primary">Go Back</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table id="example" class="table table-bordered table-striped table-responsive-sm">
                                            <thead>
                                                <tr>
                                                    <th>#</th>
                                                    <th>View</th>
                                                    <th>Submitted On</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach ($data as $key=>$item)
                                                        <tr>
                                                            <td>{{ $key+1 }}</td>
                                                            <td>
                                                                <a href="{{ route('user.generateResult',['submissionId' => $item->id]) }}">View</a>
                                                            </td>
                                                            <td>{{ \Carbon\Carbon::parse($item->submitted_on)->format('Y-m-d') }}</td>
                                                        </tr>
                                                    @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
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
    </script>
@endsection
