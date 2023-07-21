<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <link rel="shortcut icon" href="{{ url('public/website_logo.png') }}" type="image/x-icon">
  <title>सहजानंदी @yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" href="{{ url('public/images/favicon.ico') }}" type="image/x-icon">
  <link rel="shortcut icon" href="{{ url('public/images/favicon.ico') }}" type="image/x-icon">
  <!-- Google Font: Source Sans Pro -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Lato:wght@300;400&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://adminlte.io/themes/v3/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
<!-- Bootstrap CSS -->
<link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="{{url('assets/adminlte/dist/css/adminlte.min.css')}}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{url('assets/adminlte/plugins/overlayScrollbars/css/OverlayScrollbars.min.css')}}">
    <style>
        *{
         font-family: 'Lato', sans-serif;   
        }
        .main-header,.navbar-dark {
        background-image: radial-gradient( circle 610px at 5.2% 51.6%,  rgba(5,8,114,1) 0%, rgba(7,3,53,1) 97.5% );
        }
        .content-wrapper{
            background-image: radial-gradient( circle 1224px at 10.6% 8.8%,  rgba(255,255,255,1) 0%, rgba(153,202,251,1) 100.2% );
        }
        .btn-primary,.btn-primary-gradient , .btn-primary:hover{
            background-color: #6610f2;
            border-color: #6610f2;
        }
    </style>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://kit.fontawesome.com/d977d3adb6.js" crossorigin="anonymous"></script>

    @yield('css')

</head>
<body class="hold-transition layout-top-nav">

@include('frontend.partials.header')



@yield('content')



@include('frontend.partials.footer')



@yield('script')

</body>
</html>
