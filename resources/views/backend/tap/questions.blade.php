@extends('backend.layout.layout')
@section('title', 'Tap Quiz Questions')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet"
        href="{{ url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Tap Questions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Tap Questions</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>
        @if(!$questionAnswers->is_published)
            <div class="alert alert-warning">
                <b>Note:</b> This quiz has not been published yet.
            </div>
        @endif
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-header">
                                <a href="{{ route('tap.quiz.addQuestions', ['quizId' => $questionAnswers->id]) }}">
                                    <button class="btn btn-primary">Add Questions</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    @foreach ($questionAnswers->questions as $i => $item)
                                        <div class="col-md-6">
                                            <div class="card">
                                                <div class="card-header d-flex">
                                                    <div class="col-10">
                                                        <p> {{ $i+1 }}. {{ $item->question_text }}</p>
                                                    </div>
                                                    <div class="col-2">
                                                        <a href="{{ route('tap.questionDelete', ['questionId' => $item->id]) }}">
                                                            <p class="text-right"><i class="fa fa-trash" aria-hidden="true"></i></p>
                                                        </a>
                                                    </div>
                                                </div>
                                                <div class="card-body">
                                                    @foreach ($item->answers as $key=>$answer)
                                                    <div class="row">
                                                         <div class="col-md-12">
                                                            <div class="form-check">
                                                                <label class="form-check-label"
                                                                    for="answer[{{ $answer->id }}]">{{$key+1}}. {{ $answer->answer_text }}, Marks {{ $answer->marks }}
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>  
                                                    @endforeach
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
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
