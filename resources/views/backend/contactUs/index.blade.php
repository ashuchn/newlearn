@extends('backend.layout.layout')
@section('title','Niyam')
@section('css')
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.2/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="{{ url('assets/adminlte/plugins/datatables-responsive/css/responsive.bootstrap4.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
@endsection

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Update Contact Us</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Update Contact Us</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
        </section>

        <section class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-12">


                        <div class="card">
                            <div class="card-body">
                               <form action="{{ route('admin.contactus.update') }}" method="post">
                                @csrf
                                <div class="form-group">
                                    <label for="inputName">Name</label>
                                    <input type="text" value="{{ $data->contact_person_name ?? '' }}" class="form-control" name="contact_person_name" id="inputName" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputEmail">Email</label>
                                    <input type="email" value="{{ $data->email ?? '' }}" class="form-control" name="email" id="inputEmail" required>
                                </div>
                                <div class="form-group">
                                    <label for="inputMobile">Mobile</label>
                                    <input type="text" value="{{ $data->mobile_number ?? '' }}" class="form-control" name="mobile_number" id="inputMobile" required>
                                </div>
                                <div class="form-group">
                                    <input type="submit" class="btn btn-success" value="Update!">
                                </div>
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