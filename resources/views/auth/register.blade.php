<!DOCTYPE html>
<html>
<head>
    <title> Register To My Anime </title>
    @include('asset.asset')
</head>
<body>
<center>
      <img class="responsive-img" style="width: 240px;" src="img/logo.png" />
      <h5 class="teal-text">Register to My Anime</h5>

      <div class="container">
        <div class="z-depth-1 grey lighten-5 hoverable" id="register-box" style="display: inline-block; padding: 0px 60px 0px 60px; width:450px; ;border: 1px solid #EEE; border-radius:20px;">

          <form class="col s12" method="POST" action="{{url('register')}}" id="form">
            {{ csrf_field() }}
            <div class='row'>
              <div class='col s12'>
              </div>
            </div>
              <div class='row'>
              <div class="input-field col s12{{ $errors->has('name') ? ' has-error' : '' }}">
                <input type='text' name='username' id='name' autocomplete="off" required/>
                <label for='email'>Enter your username</label>
                 @if ($errors->has('username'))
                    <span class="helper-text">
                        <strong>{{ $errors->first('username') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12{{ $errors->has('email') ? ' has-error' : '' }}">
                <input type='email' name='email' id='email' autocomplete="off" required/>
                <label for='email'>Enter your Email</label>
                @if ($errors->has('email'))
                    <span class="helper-text">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type='password' name='password' id='password' autocomplete="off" required/>
                <label for='password'>Enter your Password</label>
                 @if ($errors->has('password'))
                    <span class="helper-text">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
            </div>

            <div class='row'>
              <div class='input-field col s12'>
                <input type='password' name="password_confirmation" id='password_confirmation' autocomplete="off"  required/>
                <label for='password'>Enter your Verify Password</label>
              </div>
            </div>

            <br />

            <center>
              <div class='row'>
                <button type='submit' name='login' class='col s12 btn btn-large waves-effect waves-light teal disabled' id="btn-login">Register</button>
              </div>    
              <div class="row">
                <span> Punya Akun? <a href="{{route('login')}}" class="teal-text">LOGIN</a></span>
              </div>
            </center>
          </form>
        </div>
      </div>
      <div class="row">
        <div class="section"></div>
      <a href="{{url('/')}}" class="btn teal"> <i class="material-icons left">home</i>Back To Homepage</a>
      </div>
    </center> 

     <script type="text/javascript">
    $(document).ready(function(){
        $('#form').on('click change keyup', function(){
          if($('#username').val() == "" || $('#password').val() == ""){
              $('#btn-login').addClass('disabled');
          }
          else{
            $('#btn-login').removeClass('disabled');
          }
        });

        $('#register-box').mouseover(function(){
            $('#register-box').addClass('white');
            $('#register-box').removeClass('grey');
        });

        $('#register-box').mouseout(function(){
                $('#register-box').addClass('grey');
                $('#register-box').removeClass('white');
            
        });
    });
  </script>

</body>
</html>
