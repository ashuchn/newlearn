@extends('frontend.layout.layout')
@section('title', 'Tapasaya')

{{-- @section('css')
    <!-- Select2 -->
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/select2/css/select2.min.css') }}">
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css') }}">
@endsection --}}

@section('content')
    {{-- put all the content inside content-wrapper class --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                {{-- <h3>Hello, @php echo Auth::user()->name @endphp</h3> --}}
                <div class="row">
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                <a href="{{ route('dashboard') }}"><button class="btn btn-primary">Go Back</button></a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-12 d-flex justify-content-center">
                                        <img src="{{ url('public/images/sehjanandi.jpeg') }}" class="img-thumbnail" alt="">
                                    </div>
                                </div>
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header"><h4>Download PDFs</h4></div>
                            <div class="card-body">
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.tap_vidhi') }}">
                                        <button class="btn btn-light text-center">Download Tap Vidhi PDF</button>
                                    </a>
                                </div>
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.gandhar') }}">
                                        <button class="btn btn-light text-center">Download 11 Gandhar Multiple</button>
                                    </a>
                                </div>
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.sthanak') }}">
                                        <button class="btn btn-light">Download 20 Sthanak Chataiyvandan,Stuti,Stavan</button>
                                    </a>
                                </div>
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.aagam') }}">
                                        <button class="btn btn-light text-center">Download 45 Aagam Tap Multiple</button>
                                    </a>
                                </div>
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.Chaturvinshati') }}">
                                        <button class="btn btn-light text-center">Download Chaturvinshati Multiple</button>
                                    </a>
                                </div>
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.Dharma') }}">
                                        <button class="btn btn-light text-center">Download Dharma Chakra Multiple</button>
                                    </a>
                                </div>
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.Moksh') }}">
                                        <button class="btn btn-light text-center">Download Moksh Dand Tap</button>
                                    </a>
                                </div>
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.Shrani') }}">
                                        <button class="btn btn-light text-center">Download Shrani Tap</button>
                                    </a>
                                </div>
                                <div class="mt-2 col-md-12">
                                    <a href="{{ route('download.Siddhi') }}">
                                        <button class="btn btn-light text-center">Download Siddhi Tap Multiple</button>
                                    </a>
                                </div>
                            </div>
                        </div>
                        
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection