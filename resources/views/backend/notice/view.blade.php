@extends('backend.layout.layout')
@section('title','View Notice')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>View Notice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">View Notice</li>
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
                            <!-- /.card-header -->
                            <div class="card-header">
                                <a href="{{ route('admin.notice.index') }}">
                                    <button class="btn btn-primary">Go Back</button>
                                </a>
                                <a href="{{ route('admin.notice.edit', ['id' => $data->id ]) }}">
                                    <button class="btn btn-success">Edit</button>
                                </a>
                            </div>
                            <div class="card-body">
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="title">Title</label>
                                            <input readonly type="text" name="title" value="{{$data->title }}" placeholder="Enter title of Notice" class="form-control" id="title">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Description</label>
                                            <textarea readonly name="description" id="description" cols="30" rows="5" placeholder="Enter description of Notice" class="form-control">{{$data->description }}</textarea>
                                        </div>
                                    </div>
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
