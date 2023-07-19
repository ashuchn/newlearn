@extends('frontend.layout.layout')
@section('title','Tap Quiz Result')
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
                        <h1>Tap Quiz Result</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quiz Result</li>
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
                                <div class="d-flex justify-content-left align-items-right">
                                    <a href="{{ route('user.tap.index') }}"">
                                        <button class="btn btn-warning mx-2">Go Back</button>
                                    </a>
                                    <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td><b>Marks Obtained:</b></td>
                                        <td>{{ $data->marks }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Submitted at:</b></td>
                                        <td>{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y h:i')}}</td>
                                    </tr>
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
    </script>
@endsection
