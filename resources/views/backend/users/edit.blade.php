@extends('backend.layout.layout')
@section('content')




<div class="content-wrapper">


    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>
            
              
            </h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">User Details</li>
            </ol>
          </div>
        </div>
      </div><!-- /.container-fluid -->
    </section>
@if (session('success'))
	<div class="card-body">
	<div class="alert alert-success alert-dismissible">
	<button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h5>{{ Session::get('success') }}</h5>
	<?php Session::forget('success');?>
	</div>
    </div>
	@endif
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
      
        <div class="card card-primary card-outline">
          <div class="card-header">
            <h3 class="card-title">Ashutosh</h3>
              <div class="card-tools">
				<a href="javascript:void()" data-toggle="modal" data-target="#profile" ><i class="fa fa-edit"></i></a>
				</div>
          </div>
          <div class="card-body">
            <h4></h4>


<section class="content">
      <div class="container-fluid">
        <!-- SELECT2 EXAMPLE -->
        <div class="card card-default " >
          <!-- /.card-header -->
          <div class="card-body">
            <div class="row">
			
              <div class="col-md-4">
                <div class="form-group">
                  <p><label>User Name </label></p>
                  <p>Ashutosh</p>
                </div>
              </div>
			 
			  <div class="col-md-4">
                <div class="form-group">
                  <p><label>Email</label></p>
                  <p>ashutoshchauhan129@gmail.com</p>
                </div>
              </div>
			  
			  <div class="col-md-4">
                <div class="form-group">
                  <p><label>Mobile</label></p>
                  <p>8468921900</p>
                </div>
              </div>
            </div>
           
          </div>
          <!-- /.card-body -->
         
		  
        </div>
       
        <!-- /.row -->
      </div>
	  
    </section>
	
			
          </div>
          <!-- /.card -->
        </div>
        <!-- /.card -->
		
		
        <!-- /.card -->
      </div>
      <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  @endsection