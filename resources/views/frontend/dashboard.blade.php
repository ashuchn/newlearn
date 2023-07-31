@extends('frontend.layout.layout')
@section('content')
{{-- put all the content inside content-wrapper class --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h1>जय जिनेन्द्र, @php echo Auth::user()->name @endphp!</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Home</li>
                        </ol>
                    </div>
                </div>
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="{{ route('user.quiz.index') }}" class="small-box-footer">
                            <div class="info-box bg-gradient-info">
                                <span class="info-box-icon"><i class="far fa-question"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Pravachan Question and Answers</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <!-- small box -->
                            <a href="{{ route('user.niyam.index') }}" class="small-box-footer">
                                <div class="info-box bg-gradient-success">
                                    <span class="info-box-icon"><i class="fa-solid fa-pen"></i></span>
                                    <div class="info-box-content">
                                        <span class="info-box-text">11 Niyam</span>
                                    </div>
                                </div>
                            </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <!-- small box -->
                        <a href="http://103.69.44.224:8080/shajanandi/Top10.asp?RPID=7&SID=1&V1=1&V2=7&V3=0&V4=0&V5=0"
                            class="small-box-footer">
                            <div class="info-box bg-gradient-warning">
                                <span class="info-box-icon"><i class="fa-solid fa-ranking-star"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Top 10</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <!-- small box -->
                        <a href="{{ route('user.tap.index') }}" class="small-box-footer">
                            <div class="info-box bg-gradient-warning">
                                <span class="info-box-icon"><i class="fa-solid fa-person-praying"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tap</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="{{ route('tapasaya.index') }}" class="small-box-footer">
                            <div class="info-box bg-gradient-danger">
                                <span class="info-box-icon"><i class="fa-solid fa-bell-slash"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Tapasaya</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="{{ route('notice.index') }}" class="small-box-footer">
                            <div class="info-box bg-gradient-primary">
                                <span class="info-box-icon"><i class="fa-solid fa-bell"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Notice Box</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a href="{{ route('suggestion.index') }}" class="small-box-footer">
                            <div class="info-box bg-gradient-light">
                                <span class="info-box-icon"><i class="fa-solid fa-clipboard-question"></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Suggestion Box</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <a 
                        href="http://103.69.44.224:8080/shajanandi/ReportsU.asp?RPID=8&SID={{Auth::id()}}&V1=0&V2=0&V3=0&V4=0&V5=0" 
                        class="small-box-footer">
                            <div class="info-box bg-gradient-light">
                                <span class="info-box-icon"><i class="fa-solid fa-award"></i></i></span>
                                <div class="info-box-content">
                                    <span class="info-box-text">Prize</span>
                                </div>
                            </div>
                        </a>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div> <!-- container fluid ends -->
        </div>
    </div>
@endsection

@section('script')
@endsection
