 @extends('master.master_admin')
 @section('pageTitle', 'Edit' , $user->username )
 @section('content')
<div class="header bg-gradient-custom pb-8 pt-5 pt-md-8"></div>
<div class="container-fluid  mt--9" style="margin-bottom: 50px; padding: 10px;">

<div class="row">
<div class="col-xl-6 mb-5 mb-xl-0">
			<div class="card shadow" style="padding: 10px;">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="">
                  <h4 style="">Edit User {{$user->username}}</h4>
                </div>
              </div>
            </div>
            <form action="{{route('update.users', $user->id)}}" method="POST">
            	{{ csrf_field() }}
			  <div class="row" style="padding: 10px;">
			    <div class="col-md-12">
			      <div class="form-group">
			      	<label style="font-size: 16px;">User Name </label>
			        <input type="text" name="username" class="form-control form-control-alternative" id="exampleFormControlInput1" value="{{ $user->username }}">
			      </div>
			    </div>
			    <div class="col-md-12">
			       <div class="form-group">
			      	<label style="font-size: 16px;">E-mail </label>
			        <input type="email" name="email" class="form-control form-control-alternative" id="exampleFormControlInput1" value="{{ $user->email }}">
			      </div>
			    </div>
			    <div class="col-md-12">
			       <div class="form-group">
			      	<label style="font-size: 16px;">Created At </label>
			        <input type="email" class="form-control form-control-alternative" id="exampleFormControlInput1" disabled="disabled" value="{{ $user->created_at }}">
			      </div>
			    </div>
			  </div>
			  <div class="row" style="margin: 0 0 10px 10px; ">
			  	<button class="btn btn-success"><i class="fas fa-edit"></i>  Update </button>
			  	<a href="{{route('dataProcessing')}}" class="btn btn-outline-default"><i class="fas fa-times"></i> Cancel </a>
			  </div>
			</form>
</div>
</div>
<!-- <div class="col-xl-5 mb-5 mb-xl-0">
	<div class="card shadow">

	</div>
</div> -->
</div>
 @endsection