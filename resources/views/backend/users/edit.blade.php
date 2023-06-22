@extends('backend.layout.layout')
@section('title', '| Edit User')
@section('content')
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1></h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Home</a></li>
                            <li class="breadcrumb-item active">User Details</li>
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
        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">

                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <h3 class="card-title">{{ $user->name }}</h3>
                        <div class="card-tools">
                            <a href="javascript:void()" data-toggle="modal" data-target="#profile"><i
                                    class="fa fa-edit"></i></a>
                        </div>
                    </div>
                    <div class="card-body">
                        <h4></h4>


                        <section class="content">
                            <div class="container-fluid">
                                <!-- SELECT2 EXAMPLE -->
                                <div class="card card-default ">
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <div class="row">

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p><label>User Name </label></p>
                                                    <p>{{ $user->name }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p><label>Email</label></p>
                                                    <p>{{ $user->email }}</p>
                                                </div>
                                            </div>

                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p><label>Mobile</label></p>
                                                    <p>{{ $user->mobile }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p><label>Gender</label></p>
                                                    <p>{{ $user->gender_name }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p><label>Role</label></p>
                                                    <p>{{ $user->role }}</p>
                                                </div>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="form-group">
                                                    <p><label>Joined On</label></p>
                                                    <p>{{ $user->joined_on }}</p>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <!-- /.card-body -->


                                </div>

                                <!-- /.row -->
                            </div>

                        </section>


                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.card -->


                <!-- /.card -->
            </div>
            <!-- /.container-fluid -->
        </section>
        <!-- /.content -->
    </div>
    <div class="modal fade" id="profile">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Update Profile</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">



                    <!-- SELECT2 EXAMPLE -->
                    <form action="" method="post">
                        @csrf
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">User Name</label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1"
                                        value="{{ $user->name }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Email</label>
                                    <input type="email" class="form-control" name="email" id="exampleInputEmail1"
                                        value="{{ $user->email }}">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Mobile</label>
                                    <input type="text" class="form-control" name="mobile" id="exampleInputEmail1"
                                        value="{{ $user->mobile }}">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="exampleInputEmail1">Gender</label>
                                    <select name="gender" class="form-control" required>
                                      <option value="">Choose Gender</option>
                                      @foreach ($gender as $key => $value)
                                        <option value="{{ $key }}" @if($user->gender == $key ) selected  @endif >{{$value}}</option>
                                      @endforeach
                                  </select>
                                </div>
                            </div>

                        </div>
                        <input type="hidden" class="form-control" name="riding_charter_id" id="exampleInputEmail1"
                            value="">
                        <div class="modal-footer justify-content-between">
                            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                    </form>
                </div>
                <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
        </div>
    </div>
@endsection
