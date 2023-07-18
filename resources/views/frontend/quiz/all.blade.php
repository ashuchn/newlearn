@extends('frontend.layout.layout')
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
                        <h1>Quizzes</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Quizzes</li>
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
                                <div class="d-flex justify-content-left">
                                    <a href="{{ route('user.quiz.index') }}">
                                        <button class="btn btn-danger">Go Back</button>
                                    </a>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="example" class="table table-bordered table-striped table-responsive-sm">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Quiz Name</th>
                                            <th>Start Date</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data as $key=>$item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->quiz_name }}</td>
                                                <td>{{ \Carbon\Carbon::parse($item->start_date)->toDayDateTimeString() }}</td>
                                                <td>
                                                    @if($item->hasUserGivenQuiz)
                                                        <a href="{{ route('quiz.result', ['quizId' =>$item->id]) }}">
                                                            <button class="btn-primary btn">Show Results</button>
                                                        </a>
                                                    @else
                                                        <a href="{{ route('user.takeQuiz', ['id' =>$item->id ]) }}">
                                                            <button class="btn-light btn">Take Quiz</button>
                                                        </a>
                                                    @endif
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
