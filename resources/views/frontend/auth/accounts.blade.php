<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>सहजानंदी | Choose Accounts to continue</title>
  <link rel="icon" href="{{ url('public/images/favicon.ico') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ url('public/images/favicon.ico') }}" type="image/x-icon">
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('assets/adminlte/dist/css/adminlte.min.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition">
    <div class="container">
        <div class="row mx-2 d-flex justify-content-center">
            @foreach ($data as $item)
                <div class="col-md-4">
                <div class="card mt-5">
                  <div class="card-body">
                    <form action="{{ route('account.login') }}" method="post">
                        @csrf
                        <input type="hidden" name="model" value="{{ $item->id }}">
                        <h5 class="card-title"><b>{{ $item->name }}</b></h5>
                        <p class="card-text">Login using {{ $item->name }}</p>
                        <input type="submit" class="btn btn-primary" value="Login">
                    </form>
                  </div>
                </div>
              </div>
            @endforeach
        </div>
    </div>

<!-- jQuery -->
<script src="{{url('assets/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/adminlte/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
