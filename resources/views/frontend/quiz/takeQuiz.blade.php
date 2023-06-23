@extends('frontend.layout.layout')
@section('title', 'Take Quiz')
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
                        <h1>Quiz</h1>
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
        <div class="alert alert-warning">
            Note:
            <ol>
                <li>Do not refresh the page, All saved data will be lost.</li>
                <li>Once submitted, you cannot submit again.</li>
            </ol>
        </div>
        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">

                        <form action="{{ route('user.submitQuiz', ['id' => request()->route('id')]) }}" method="post">
                            @csrf
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        @foreach ($questionAnswers as $i => $item)
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header d-flex">
                                                            <p> {{ $i+1 }}. {{ $item->question }}</p>
                                                    </div>
                                                    <div class="card-body">
                                                        <div class="row">
                                                        @foreach ($item->answers as $key=>$answer)
                                                             <div class="col-md-12">
                                                                <div class="form-check">
                                                                    <input class="form-check-input" type="radio" value={{ $answer->id }} name="answer[{{ $item->id }}]"
                                                                        id="answer[{{ $answer->id }}]">
                                                                    <label class="form-check-label"
                                                                        for="answer[{{ $answer->id }}]">{{$key+1}}. {{ $answer->answer_text }}</label>
                                                                </div>
                                                            </div>
                                                            @endforeach
                                                        </div>  
                                                    </div>
                                                </div>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- /.card-body -->
                            </div>
                            <!-- /.card -->
                            <input type="submit" value="Submit!" class="btn btn-success">
                        </form>
                        
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
