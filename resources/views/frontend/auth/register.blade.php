<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Register</title>
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


<!-- jQuery -->
<script src="{{url('assets/adminlte/plugins/jquery/jquery.min.js')}}"></script>
<script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
<link rel="stylesheet" href="//code.jquery.com/ui/1.13.2/themes/base/jquery-ui.css">
<script>
  $( function() {
    $( "#datepicker" ).datepicker({
      dateFormat: 'dd/mm/yy',
      showButtonPanel: true,
      changeMonth: true,
      changeYear: true,
      yearRange: "-100:+0",
    });
  } );
  </script>

</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="card card-outline card-primary">
    @php
      if(Session::has('err_msg')){
        Session::get('err_msg');
      }
    @endphp
    <div class="card-header text-center">
      <b>Registration</b>
    </div>
    <div class="card-body">
      <p class="login-box-msg">Register a new membership</p>

      {{-- <form action="{{ route('register.post') }}" method="post">
        @csrf
        <div class="form-group">
          <div class="input-group mb-3">
            <input type="text" name="name" class="form-control" placeholder="Full name">
            <div class="input-group-append">
              <div class="input-group-text">
                <span class="fas fa-user"></span>
              </div>
            </div>
          </div>
          @error('name')
            <span class="text-danger">{{ $message }}</span>
          @enderror
        </div>
        
        <div class="input-group mb-3">
          <input type="email" name="email" class="form-control" placeholder="Email">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        @error('email')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="input-group mb-3">
          <input type="text" name="mobile" class="form-control" placeholder="Mobile">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-phone"></span>
            </div>
          </div>
        </div>
        @error('mobile')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="input-group mb-3">
          <input type="password" name="password" class="form-control" placeholder="Password">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        @error('password')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="input-group mb-3">
          <input type="text" id="datepicker" name="date_of_birth" class="form-control" placeholder="Date of Birth">
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-calendar"></span>
            </div>
          </div>
        </div>
        @error('date_of_birth')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="input-group mb-3">
          <select name="" id="" class="form-control">
            <option value="">Choose Gender</option>
            <option value="1">Male</option>
            <option value="2">Female</option>
          </select>
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-mars-double"></span>
            </div>
          </div>
        </div>
        @error('gender')
            <span class="text-danger">{{ $message }}</span>
        @enderror
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="agreeTerms" name="terms" value="agree">
              <label for="agreeTerms">
               I agree to the <a href="#">terms</a>
              </label>
            </div>
          </div>
          <!-- /.col -->
          <div class="col-4">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
          </div>
          <!-- /.col -->
        </div>
      </form> --}}
      <form action="{{ route('register.post') }}" method="post">
        @csrf
        <div class="form-group">
            <label for="name">Full name</label>
            <div class="input-group">
                <input type="text" name="name" id="name" class="form-control" placeholder="Full name" value="{{ old('name') }}" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-user"></span>
                    </div>
                </div>
            </div>
            @error('name')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="email">Email</label>
            <div class="input-group">
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" placeholder="Email">
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-envelope"></span>
                    </div>
                </div>
            </div>
            @error('email')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="mobile">Mobile</label>
            <div class="input-group">
                <input type="text" name="mobile" id="mobile" class="form-control" value="{{ old('mobile') }}" placeholder="Mobile" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-phone"></span>
                    </div>
                </div>
            </div>
            @error('mobile')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="password">Password</label>
            <div class="input-group">
                <input type="password" name="password" id="password" class="form-control" placeholder="Password" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-lock"></span>
                    </div>
                </div>
            </div>
            @error('password')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="datepicker">Date of Birth</label>
            <div class="input-group">
                <input type="text" name="date_of_birth" id="datepicker" value="{{ old('date_of_birth') }}" class="form-control" placeholder="Date of Birth" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-calendar"></span>
                    </div>
                </div>
            </div>
            @error('date_of_birth')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        <div class="form-group">
            <label for="gender">Gender</label>
            <div class="input-group">
                <select name="gender" class="form-control" required>
                    <option value="">Choose Gender</option>
                    @foreach ($gender as $key => $value)
                      <option value="{{ $key }}" @if(old('gender') == $key ) selected  @endif >{{$value}}</option>
                    @endforeach
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                        <span class="fas fa-mars-double"></span>
                    </div>
                </div>
            </div>
            @error('gender')
            <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
    
        {{-- <div class="form-group">
            <div class="icheck-primary">
                <input type="checkbox" id="agreeTerms" name="terms" value="agree" required>
                <label for="agreeTerms">
                    I agree to the <a href="#">terms</a>
                </label>
            </div>
        </div> --}}
    
        <div class="form-group">
            <button type="submit" class="btn btn-primary btn-block">Register</button>
        </div>
    </form>

      <a href="{{ route('login') }}" class="text-center">I already have a membership</a>
    </div>
    <!-- /.form-box -->
  </div><!-- /.card -->
</div>
<!-- /.register-box -->

<!-- Bootstrap 4 -->
<script src="{{url('assets/adminlte/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{url('assets/adminlte/dist/js/adminlte.min.js')}}"></script>
</body>
</html>
