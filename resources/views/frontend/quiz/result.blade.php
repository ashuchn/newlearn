@extends('frontend.layout.layout')
@section('title','Daily Quiz')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <style>
        /* Style for the correct answer radio button */
        .input.text-success[type="radio"]:checked {
            border-color: #28a745; /* Green color */
        }

        /* Style for the wrong answer radio button */
        .form-check-input.text-danger:checked {
            border-color: #dc3545; /* Red color */
        }
    </style>
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Quiz Result</h1>
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
                                    <a href="{{ route('user.todayQuiz') }}">
                                        <button class="btn btn-warning mx-2">Go Back</button>
                                    </a>
                                    <button class="btn btn-primary" onclick="window.print();"><i class="fa fa-print" aria-hidden="true"></i> Print</button>
                                </div>
                            </div>
                            <div class="card-body">
                                <table id="" class="table table-bordered">
                                    <tbody>
                                    <tr>
                                        <td><b>Quiz Name:</b></td>
                                        <td>{{ $quiz->quiz_name }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Total Marks:</b></td>
                                        <td>{{ $totalQuestions }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Marks Obtained:</b></td>
                                        <td>{{ $totalMarks }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Correct Answers:</b></td>
                                        <td>{{ $correctAnswers }}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Incorrect Answers:</b></td>
                                        <td>{{ $incorrectAnswers}}</td>
                                    </tr>
                                    <tr>
                                        <td><b>Submitted at:</b></td>
                                        <td>{{ \Carbon\Carbon::parse($userResponseId->created_at)->format('d-m-Y h:i A') }}</td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                        @if($showDetailedResult || Auth::user()->role_id == 1)
                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-header">
                               <h4>Detailed Result</h4>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($questionAnswers->questions as $i => $item)
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header d-flex">
                                                        <p> {{ $i+1 }}. {{ $item->question }}</p>
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($item->answers as $key=>$answer)
                                                    <div class="row">
                                                         <div class="col-md-6">
                                                            <div class="form-check">
                                                                <input class="form-check-input" type="radio" name="answer[{{ $answer->id }}]"
                                                                    id="answer[{{ $answer->id }}]"
                                                                    {{ $answer->is_correct == 1 ?  'checked' : '' }} disabled>
                                                                <label class="form-check-label"
                                                                    for="answer[{{ $answer->id }}]">{{$key+1}}. {{ $answer->answer_text }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    @endforeach
                                                    <p>Your Answer: {{ $submittedAnswers[$i]?->answer?->answer_text }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>
                            <!-- /.card-body -->
                        </div>
                        @else
                        <div class="alert alert-primary">Check again tommorow for Detailed answer submission</div>
                        @endif
                        
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
