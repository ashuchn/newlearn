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
        <section class="content-header">
            <div class="container-fluid">
              <div class="row mb-2">
                <div class="col-sm-6">
                  <h1>Contact us</h1>
                </div>
                <div class="col-sm-6">
                  <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">Home</a></li>
                    <li class="breadcrumb-item active">Contact us</li>
                  </ol>
                </div>
              </div>
                <!-- Default box -->
                <div class="card">
                    <div class="card-body row">
                        <div class="col-5 text-center d-flex align-items-center justify-content-center">
                        <div class="">
                            <img src="{{ url('public/images/login_logo.png') }}" class="img-thumbnail" alt="">
                        </div>
                        </div>
                        <div class="col-7">
                            <p><u>In case of any query, reach out to person mentioned below:</u></p>
                        <div class="form-group">
                            <label for="inputName">Name</label>
                            <p>Dhawall Kochar</p>
                        </div>
                        <div class="form-group">
                            <label for="inputEmail">E-Mail</label>
                            <p class="">dhawalkochar@gmail.com</p>
                        </div>
                        <div class="form-group">
                            <label for="inputSubject">Mobile</label>
                            <p>+91-8468921900</p>
                        </div>
                        </div>
                    </div>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
          </section>    
    </div>
@endsection