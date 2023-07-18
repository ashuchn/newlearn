@extends('backend.layout.layout')
@section('title','Edit Notice')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Edit Notice</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Edit Notice</li>
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
                            </div>
                            <div class="card-body">
                                <form action="{{ route('admin.notice.update', ['id' => $data->id]) }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="title">Title</label>
                                            <input required type="text" name="title" value="{{ $data->title }}" placeholder="Enter title of Notice" class="form-control" id="title">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Description</label>
                                            <textarea name="description" id="description" cols="30" rows="5" placeholder="Enter description of Notice" class="form-control">{{ $data->description }}</textarea>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <input type="submit" value="Update" class="btn btn-success">
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
