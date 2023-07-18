@extends('frontend.layout.layout')
@section('title', 'Suggestion')

@section('content')
    {{-- put all the content inside content-wrapper class --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6"></div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Suggestion</li>
                        </ol>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-4">
                        <div class="">
                            <img src="{{ url('public/images/login_logo.png') }}" class="img-thumbnail" alt="">
                        </div>
                    </div>
                    <div class="col-md-8 mt-2">
                        <div class="card card-primary card-outline">
                            <div class="card-header d-flex align-items-center justify-content-center"><h4>Suggestion Box</h4></div>
                            <div class="card-body">
                                <form action="{{ route('suggestion.save') }}" method="post">
                                    @csrf
                                    <div class="row">
                                        <div class="form-group col-md-12">
                                            <label for="subject">Subject:</label>
                                            <input type="text" required class="form-control " name="subject" placeholder="Subject for suggestions" value="{{ old('subject') }}">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="description">Description:</label>
                                            <textarea class="form-control" required rows="5" name="description" placeholder="write suggestion in max 250 words" value="{{ old('subject') }}"></textarea>
                                        </div>
                                        <div class="form-group col-md-12">
                                            <label for="anonymous">Do you want to send suggestion anonymously?</label>
                                            <input type="checkbox" name="anonymous" id="anonymous" value="1">
                                        </div>
                                        <div class="form-group col-md-12">
                                            <input type="submit" value="Send Suggestion!" class="btn btn-primary">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>
@endsection