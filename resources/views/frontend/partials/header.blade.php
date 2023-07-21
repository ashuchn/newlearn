<div class="wrapper">

    <!-- Navbar -->
    <nav class="main-header navbar navbar-expand-md navbar-dark navbar-dark">
      <div class="container">
        <a href="{{ route('dashboard') }}" class="navbar-brand">
        <img src="{{ url("public/images/favicon-32x32.png") }}" alt="Logo" class="brand-image img-circle elevation-3"
               style="opacity: .8">
          <span class="brand-text font-weight-light">सहजानंदी</span>
        </a>
        
        <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
  
        <div class="collapse navbar-collapse order-3" id="navbarCollapse">
          <!-- Left navbar links -->
          <ul class="navbar-nav">
            <li class="nav-item">
              <a href="{{ route('dashboard') }}" class="nav-link">Home</a>
            </li>
            <li class="nav-item">
              <a href="{{ route('contact-us') }}" class="nav-link">Contact Us</a>
            </li>
          </ul>
        </div>
  
        <!-- Right navbar links -->

        <ul class="order-1 order-md-3 navbar-nav navbar-no-expand ml-auto">
            <li>
                <a href="{{ route('logout') }}">
                    <button class="btn btn-primary">Logout</button></li>
                </a>
        </ul>
      </div>
    </nav>
    <!-- /.navbar -->