@extends('backend.layout.layout')
@section('title','Create Tap Daily Quiz')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Create Tap Quiz</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Create Tap Quiz</li>
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
                                <a href="{{ route('tap.index') }}">
                                    <button class="btn btn-primary">Go Back</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('tap.save') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-4">
                                            <label for="quiz_name">Tap Name</label>
                                            <input required type="text" name="tap_text" value="{{ old('tap_text') }}" placeholder="Enter Tap Name" class="form-control" id="quiz_name">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="time_of_the_day">Tap Time:</label>
                                            <select required class="form-control" name="time_of_the_day" id="time_of_the_day">
                                                <option value="">Choose any option:</option>
                                                <option value="1">दिन के तप</option>
                                                <option value="2">रात के तप</option>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="marks">Marks</label>
                                            <input required type="text" name="marks" value="{{ old('marks') }}" placeholder="Enter Marks" class="form-control" id="marks">
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Save" class="btn btn-success">
                                            </div>
                                        </div>
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
@section('script')
    
@endsection
