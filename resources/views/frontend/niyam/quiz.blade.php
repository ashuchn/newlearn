@extends('frontend.layout.layout')
@section('title', 'Take Niyam Quiz')

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
                {{-- <h3>Hello, @php echo Auth::user()->name @endphp</h3> --}}

                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12">
                                <table class="table table-bordered">
                                    <thead>
                                        <tr>
                                            <th>Niyam</th>
                                            <th>Options</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <form method="post" action="{{ route('user.saveNiyam') }}">
                                            @csrf
                                            @foreach ($data as $item)
                                                <tr>
                                                    <td>{{ $item->niyam_name }}</td>
                                                    <td>
                                                        <div class="form-group">
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    value="1" name="niyam[{{ $item->id }}]"
                                                                    id="1" required>
                                                                <label class="form-check-label" for="1">Yes</label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    value="0" name="niyam[{{ $item->id }}]"
                                                                    id="0" required>
                                                                <label class="form-check-label" for="0">No</label>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @endforeach
                                    </tbody>
                                </table>
                                <div class="d-flex justify-content-center">
                                    <button class="btn-success btn">Submit</button>
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

{{-- @section('script')
    <!-- Select2 -->
    <script src="{{ url('assets/adminlte/plugins/select2/js/select2.full.min.js') }}"></script>
    <script>
        $(function() {
            //Initialize Select2 Elements
            // $('.qna_dates').select2()

            //Initialize Select2 Elements
            $('.qna_dates').select2({
                theme: 'bootstrap4'
            })
        });
    </script>
@endsection --}}
