@extends('frontend.layout.layout')
@section('title', 'Take Tap Quiz')

@section('content')
    {{-- put all the content inside content-wrapper class --}}
    <div class="content-wrapper">
        <div class="content-header">
            <div class="alert alert-warning">
                Note:
                <ol>
                    <li>Do not refresh the page, All saved data will be lost.</li>
                    <li>Once submitted, you cannot submit again.</li>
                    <li>All the questions are optional.</li>
                </ol>
            </div>
            <div class="container-fluid">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                
                                    <form action="{{ route('tap.submit') }}" method="post">
                                        @csrf
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">दिन के तप</div>
                                                    <div class="card-body">
                                                        <select class="form-control"  name="morning_tap" id="morning_tap" required>
                                                            <option value="">Choose any Option</option>
                                                            @foreach ($morningTaps as $item)
                                                                <option value="{{ $item->marks }}">{{ $item->tap_text }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="card">
                                                    <div class="card-header">रात के तप </div>
                                                    <div class="card-body">
                                                        <select class="form-control"  name="night_tap" id="night_tap" required>
                                                            <option value="">Choose any Option</option>
                                                            @foreach ($nightTaps as $item)
                                                                <option value="{{ $item->marks }}">{{ $item->tap_text }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button class="btn-success btn">Submit</button>
                                        </div>
                                    </form>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection