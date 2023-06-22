@extends('frontend.layout.layout')
@section('title', 'QNA')

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
                <div class="container-fluid mb-2">
                    <a href="{{ URL::previous() }}"><button class="btn btn-primary">Go Back</button></a>
                </div>
                <div class="card">
                    <div class="card-header">
                        <form action="" class="form-inline">
                            <div class="form-group mr-2">
                                <label for="qna_dates" class="mr-2">Date:</label>
                                <select name="qna_dates" id="qna_dates" class="qna_dates form-control">
                                    <option value="">Choose Date</option>
                                    <option value="1">21 June 2023</option>
                                    <option value="2">22 June 2023</option>
                                    <option value="3">23 June 2023</option>
                                    <option value="4">24 June 2023</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <input type="submit" value="Search Result" class="btn btn-success">
                            </div>
                        </form>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="info-box bg-gradient-warning">
                                    <span class="info-box-icon"><i class="far fa-copy"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">All Quizzes</span>
                                      <span class="info-box-number">13,648</span>
                                    </div>
                                  </div>
                                  
                            </div>
                            <div class="col-md-4">
                                <div class="info-box bg-gradient-info">
                                    <span class="info-box-icon"><i class="far fa-question"></i></span>
                                    <div class="info-box-content">
                                      <span class="info-box-text">Today's Quiz</span>
                                      <span class="info-box-number"><a href="#" class="text-white">Take Quiz</a></span>
                                    </div>
                                  </div>
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
