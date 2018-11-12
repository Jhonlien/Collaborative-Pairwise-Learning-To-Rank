@extends('master.master_user')

@section('content')
      <br><br><br>
      <div class="container">
        <div class="row">
        <div class="col s6">
        <div class="z-depth-1 white lighten-5" id="box-edit" style="  display: inline-block; padding: 0px 60px 0px 60px; width:450px; border: 0px solid #EEE;border-top:4px solid #4db6ac;
">
          <form class="col s12" method="POST" action="{{route('index.edit.save')}}">
            {{ csrf_field() }}
            <div class='row'>
              <div class='col s12'>
                 <h5 class="teal-text">Edit Account</h5>
              </div>
            </div>
              <div class='row'>
              <div class="input-field col s12">
                <input type='text' name='username' id='name' autocomplete="off" required value="{{ $user->username }}" />
                <label for='email'>Enter your username</label>
              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12">
                <input type='email' name='email' id='email' autocomplete="off" required value="{{ $user->email }}"/>
                <label for='email'>Enter your Email</label>
              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12">
                <input type='password' name='old_password' id='password' autocomplete="off"/>
                <label for='password'>Enter Your Old Password</label>
              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12">
                <input type='password' name='new_password' id='password' autocomplete="off"/>
                <label for='password'>Enter your New Password</label>
              </div>
            </div>

             <div class='row'>
                <button type='submit' name='submit' class='col s12 btn btn-large waves-effect waves-light teal white-text hoverable'> 
                	Update
                </button>
             </div> 
        </form>
      </div>
    </div>
    <div class="col s6">
      <div class="z-depth-1 white lighten-5" id="register-box" style="display: inline-block; padding: 0px 60px 0px 60px; width:450px; ;border: 1px solid #EEE;">
          
      </div>
  </div>
  </div>
</div>
@endsection