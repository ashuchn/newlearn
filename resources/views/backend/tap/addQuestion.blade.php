@extends('backend.layout.layout')
@section('title', 'Tap Add Question')
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
                                <form method="post" action="{{ route('tap.saveQuestion', ['quizId' => request()->route('quizId')]) }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="question">Question</label>
                                        <input type="text" class="form-control" id="question" name="question" placeholder="Enter Question Text" required>
                                    </div>
                                    
                                    <div class="form-group">
                                        <label for="answers">Answers</label>
                                        <div id="answers">
                                            <div class="form-row">
                                                <div class="col">
                                                    <input type="text" class="form-control" name="answer[]" placeholder="Enter Answer" required>
                                                </div>
                                                <div class="col">
                                                    <input type="number" class="form-control" name="marks[]" placeholder="Enter Marks" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="button" class="btn btn-light mt-2" id="addAnswer">Add Answer</button>
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
<script>
    document.getElementById('addAnswer').addEventListener('click', function () {
        var answersContainer = document.getElementById('answers');

        var formRow = document.createElement('div');
        formRow.className = 'form-row';

        var answerCol = document.createElement('div');
        answerCol.className = 'col';
        var answerInput = document.createElement('input');
        answerInput.type = 'text';
        answerInput.className = 'form-control';
        answerInput.name = 'answer[]';
        answerInput.required = true;
        answerCol.appendChild(answerInput);
        formRow.appendChild(answerCol);

        var marksCol = document.createElement('div');
        marksCol.className = 'col';
        var marksInput = document.createElement('input');
        marksInput.type = 'number';
        marksInput.className = 'form-control';
        marksInput.name = 'marks[]';
        marksInput.required = true;
        marksCol.appendChild(marksInput);
        formRow.appendChild(marksCol);

        answersContainer.appendChild(formRow);
    });
</script>
@endsection
