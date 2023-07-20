@extends('frontend.layout.layout')
@section('title','Niyam Result')
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
                        <h1>Niyam Result</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Niyam Result</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="d-flex justify-content-left align-items-right">
                                    <a href="{{ route('user.niyam.pastSubmission') }}">
                                        <button class="btn btn-warning mx-2">Go Back</button>
                                    </a>
                                    <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th style="width: 33%">Total Marks</th>
                                            <th style="width: 33%">Marks Obtained</th>
                                            <th style="width: 33%">Submitted At</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td>
                                                {{ $totalMarks }}
                                            </td>
                                            <td>
                                                {{ $obtainedMarks }}
                                            </td>
                                            <td>{{ \Carbon\Carbon::parse($niyamSubmission->created_at)->format('d-m-Y h:i A') }}</td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>

                @if($showDetailedResult)
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12">
                                        <table class="table table-bordered">
                                            <thead>
                                                <tr>
                                                    <th>Niyam</th>
                                                    <th>Options</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                    @foreach ($data as $item)
                                                        <tr>
                                                            <td style="width: 50%">{{ $item['niyam']->niyam_name }}</td>
                                                            <td style="width: 50%">
                                                                <div class="form-group">
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            value="1" name="niyam[{{ $item->id }}]"
                                                                            id="1" {{ $item->answer == 1 ? 'checked' : '' }} disabled>
                                                                        <label class="form-check-label" for="1">Yes</label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input class="form-check-input" type="radio"
                                                                            value="0" name="niyam[{{ $item->id }}]"
                                                                            id="0" {{ $item->answer == 0 ? 'checked' : '' }} disabled>
                                                                        <label class="form-check-label" for="0">No</label>
                                                                    </div>
                                                                </div>
                                                            </td>
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
                @else
                    <div class="alert alert-primary">Check again tommorow for Detailed answer submission</div>
                @endif
                
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
