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
<div class="d-flex justify-content-center mt-4">
  <div class="card card-outline card-primary">
    <div class="card-header text-center">
      <b>Register a new membership</b>
    </div>
    <div class="card-body">
      <p class="login-box-msg text-danger">Asterisk(*) marked field are mandatory</p>
      <form action="{{ route('register.post') }}" method="post">
        @csrf
        
        <div class="form-group row">
          <div class="col-md-6">
                <label for="name">Full name <span class="text-danger">*</span></label>
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
          <div class="col-md-6">
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
        </div>

        <div class="form-group row">
            <div class="col-md-6">
              <label for="mobile">Mobile <span class="text-danger">*</span></label>
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
            <div class="col-md-6">
              <label for="password">Password <span class="text-danger">*</span></label>
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
        </div>
    
        <div class="form-group row">
          <div class="col-md-6">
            <label for="state">State: <span class="text-danger">*</span></label>
            <div class="input-group">
                <select name="state_id" class="form-control" id="state" required>
                  <option value="">Choose State</option>
                  @foreach($states as $state)
                    <option value="{{ $state->id }}">{{ $state->name }}</option>
                  @endforeach
                </select>
                <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="fa-sharp fa-light fa-location-crosshairs"></i>
                    </div>
                </div>
            </div>
            @error('state_id')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
          <div class="col-md-6">
            <label for="city">City: <span class="text-danger">*</span></label>
            <div class="input-group">
              <input type="text" name="city" id="" value="{{ old('city') }}" class="form-control" placeholder="City" required>
                <div class="input-group-append">
                    <div class="input-group-text">
                      <i class="fa-thin fa-location-pin"></i>
                    </div>
                </div>
            </div>
            @error('city')
            <span class="text-danger">{{ $message }}</span>
            @enderror
          </div>
        </div>

        <div class="form-group row">
          <div class="col-md-6">
            <label for="datepicker">Date of Birth <span class="text-danger">*</span></label>
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
            <div class="col-md-6">
              <label for="gender">Gender <span class="text-danger">*</span></label>
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
        </div>

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
