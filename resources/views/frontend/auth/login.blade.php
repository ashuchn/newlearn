<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>सहजानंदी User Login</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="{{ url('public/images/favicon.ico') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ url('public/images/favicon.ico') }}" type="image/x-icon">

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
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <img src="{{ url('public/images/Sahjanandi Aaradhana a.png') }}" class="img-thumbnail" alt="login logo">
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
        @if (session()->has('err_msg'))
            <span class="text-danger">{{ session()->get('err_msg') }}</span>
        @endif
        <div class="login-logo">
          <a href="#"><b>आराधक लॉग इन</b></a>
        </div>
      <p class="login-box-msg">Sign in to start your session</p>

      {{-- <form action="{{ route('login.post') }}" method="post">
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control @error('email') ? ' is-invalid' : '' @enderror" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
            @error('email')
                <span class="text-danger">{{ $message }}</span>
            @enderror
		    @csrf
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control @error('productName') ? ' is-invalid' : '' @enderror" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
            @error('password')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form> --}}
      <form action="{{ route('login.post') }}" method="post">
        @csrf
        <label for="email">Mobile Number</label>
        <div class="input-group mb-3">
            <input type="text" name="mobile" class="form-control @error('mobile') is-invalid @enderror" placeholder="Enter registered Mobile Number">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-envelope"></span>
                </div>
            </div>
        </div>
        @error('email')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    
        <label for="password">Password</label>
        <div class="input-group mb-3">
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror" placeholder="Password">
            <div class="input-group-append">
                <div class="input-group-text">
                    <span class="fas fa-lock"></span>
                </div>
            </div>
        </div>
        @error('password')
        <span class="text-danger">{{ $message }}</span>
        @enderror
    
        <div class="row">
            <div class="col-8">
                {{-- <div class="icheck-primary">
                    <input type="checkbox" id="remember" name="remember">
                    <label for="remember">
                        Remember Me
                    </label>
                </div> --}}
            </div>
            <div class="col-4">
                <button type="submit" class="btn btn-primary btn-block">Sign In</button>
            </div>
        </div>
    </form>
    
      <p class="mb-0">
        <a href="{{ route('register') }}" class="text-center">आराधक पंजीकरण </a>
      </p>

     
    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{url('assets/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/adminlte/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
