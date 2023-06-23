@extends('backend.layout.layout')
@section('title', 'Add Question')
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
                        <h1>Questions</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Questions</li>
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


                        <div class="card">
                            <!-- /.card-header -->
                            <div class="card-header">
                                <a href="{{ URL::previous() }}">
                                    <button class="btn btn-primary">Back</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('quiz.saveQuestionAnswer', ['quizId' => request()->route('quizId')]) }}" method="post">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="question" class="form-label">Question:</label>
                                        <input type="text" class="form-control" value="{{ old('question') }}" id="question" name="question" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer1" class="form-label">Answer 1:</label>
                                        <input type="text" class="form-control" value="{{ old('answer[1]') }}" id="answer1" name="answer[]" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer2" class="form-label">Answer 2:</label>
                                        <input type="text" class="form-control" id="answer2" value="{{ old('answer[2]') }}" name="answer[]" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer3" class="form-label">Answer 3:</label>
                                        <input type="text" class="form-control" id="answer3" value="{{ old('answer[3]') }}" name="answer[]" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="answer4" class="form-label">Answer 4:</label>
                                        <input type="text" class="form-control" id="answer4" value="{{ old('answer[4]') }}" name="answer[]" required>
                                    </div>
                                    <div class="mb-3">
                                        <label for="correctAnswer" class="form-label">Correct Answer:</label>
                                        <select class="form-select" id="correctAnswer" name="correctAnswer" required>
                                            <option value="1">Answer 1</option>
                                            <option value="2">Answer 2</option>
                                            <option value="3">Answer 3</option>
                                            <option value="4">Answer 4</option>
                                        </select>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
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
