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
                
                <div class="card">
                    <div class="card-header">
                        <a href="{{ route('dashboard') }}"><button class="btn btn-primary">Go Back</button></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 d-flex justify-content-center">
                                <img src="{{ url('public/images/sehjanandi.jpeg') }}" class="img-thumbnail" alt="">
                            </div>
                            <div class="mt-2 col-md-12 d-flex justify-content-center">
                                <a href="{{ route('download.tap_vidhi') }}">
                                    <button class="btn btn-primary text-center">Tap Vidhi</button>
                                </a>
                              </div>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection