@extends('backend.layout.layout')
@section('title','Suggestion')

@section('content')
    <div class="content-wrapper">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>Suggestion</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="#">Dashboard</a></li>
                            <li class="breadcrumb-item active">Suggestion</li>
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
                    <div class="col-md-12">
                        <div class="card card-primary card-outline">
                            <div class="card-header">
                                <a href="{{ route('admin.suggestion.index') }}">
                                    <button class="btn btn-light btn-outline-danger">Go back</button>
                                </a>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="form-group col-md-12">
                                        <label for="subject">Subject:</label>
                                        <input type="text" required class="form-control " name="subject" value="{{ $data->subject }}" readonly>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="description">Description:</label>
                                        <textarea class="form-control" required rows="5" name="description" readonly>{{ $data->description }}</textarea>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="anonymous">Submitted By:</label>
                                        <input type="text" class="form-control" value="{{ $data->user->name ?? "Anonymous" }}" readonly>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="anonymous">Submitted On:</label>
                                        <input type="text" class="form-control" value="{{ \Carbon\Carbon::parse($data->created_at)->format('d-m-Y') }}" readonly>
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