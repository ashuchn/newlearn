@extends('backend.layout.layout')
@section('title','Suggestions')
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
                        <h1>Suggestions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Suggestions</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        @if (session('success'))
            <div class="card-body">
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                    <h5>{{ Session::get('success') }}</h5>
                    <?php Session::forget('success'); ?>
                </div>
            </div>
        @endif
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card card-primary card-outline">
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>User</th>
                                            <th>Date</th>
                                            <th>Subject</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key=>$item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->user->name ?? "Anonymous" }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->created_at)->format('d-m-Y') }}</td>
                                                <td>{{ $item->subject }}</td>
                                                <td class="d-flex justify-content-center">
                                                    <a href="{{ route('admin.suggestion.view', ['id' => $item->id ]) }}">
                                                        <button class="mx-1 btn-sm btn-success btn">View More</button>
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
        </script>
@endsection