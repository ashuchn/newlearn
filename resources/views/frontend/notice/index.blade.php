@extends('frontend.layout.layout')
@section('title', 'Notices')

@section('content')
    {{-- put all the content inside content-wrapper class --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-3">
                    <div class="col-sm-6">
                        <h3>Notices</h3>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Home</a></li>
                            <li class="breadcrumb-item active">Notices</li>
                        </ol>
                    </div>
                </div>
                <div class="card card-primary card-outline">
                    <div class="card-header">
                        <a href="{{ route('dashboard') }}" class="">
                            <button class="btn btn-primary">Go back</button>
                        </a>
                    </div>
                    <div class="card-body">
                        <section id="notices">
                            <div class="container-fluid">
                              <div class="row">
                                @foreach ($data as $notice)
                                <div class="col-md-6">
                                  <div class="card mb-4">
                                    <div class="card-body">
                                      <h4 class="card-title">{{ $notice->title }}</h4>
                                      <p class="card-text">{{ $notice->description }}</p>
                                    </div>
                                    <div class="card-footer text-muted">
                                      Created at: {{ $notice->created_at->format('d-m-Y H:i:s') }}
                                    </div>
                                  </div>
                                </div>
                                @endforeach
                              </div>
                            </div>
                        </section>
                        <!-- Display pagination links -->
                        <div class="d-flex justify-content-center mt-4">
                            {!! $data->links() !!}
                        </div>
                    </div>
                </div>
                
                  
               
            </div>
        </div>
    </div>
@endsection