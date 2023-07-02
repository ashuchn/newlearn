@extends('frontend.layout.layout')
@section('title', 'Tap')

@section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection

@section('content')
    {{-- put all the content inside content-wrapper class --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                {{-- <h3>Hello, @php echo Auth::user()->name @endphp</h3> --}}
                
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('dashboard') }}"><button class="btn btn-primary">Go Back</button></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <a href="{{ route('user.tap.pastSubmissions') }}" class="text-white">
                                    <div class="info-box bg-gradient-warning">
                                        <span class="info-box-icon"><i class="far fa-copy"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">Past Submissions</span>
                                        </div>
                                    </div>
                                </a>
                            </div>
                            <div class="col-md-4">
                                <a href="{{ route('user.tap.todayQuiz') }}" class="text-white">
                                    <div class="info-box bg-gradient-info">
                                        <span class="info-box-icon"><i class="far fa-question"></i></span>
                                        <div class="info-box-content">
                                          <span class="info-box-text">Today's Quiz</span>
                                        </div>
                                    </div>
                                </a>
                                
                            </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- Select2 -->
    <script src="{{ url('assets/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            // $('.qna_dates').select2()

            //Initialize Select2 Elements
            $('.qna_dates').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endsection
