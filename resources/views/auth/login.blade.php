<!DOCTYPE html>
<html>
<head>
    <title> Login To My Anime </title>
    @include('asset.asset')
</head>
<body>
    <div class="section"></div>
    <center>
      <img class="responsive-img" style="width: 250px;" src="img/logo.png" />
      <h5 class="teal-text">Login to My Anime</h5>

      <div class="container">
        <div class="z-depth-1 lighten-5 hoverable grey" id="login-box" style="display: inline-block; padding: 0px 60px 0px 60px; width:450px;border: 1px solid #EEE; border-radius: 10px;">

          <form class="col s12" id="form" method="POST" action="{{ route('login') }}">
            {{ csrf_field() }}
            <div class='row'>
              <div class='col s12'>
                 <div class="form-group">
                </div>
              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12 {{ $errors->has('email') ? ' has-error' : '' }}">
                <input type='email' name='email' id="email" autocomplete="off" />
                <label for='email'>Enter your email</label>

                @if ($errors->has('email'))
                    <span class="helper-text">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif

              </div>
            </div>

            <div class='row'>
              <div class="input-field col s12{{ $errors->has('password') ? ' has-error' : '' }}">
                <input type='password' name='password' id="password" autocomplete="off" />
                <label for='password'>Enter your password</label>
                 @if ($errors->has('password'))
                    <span class="helper-text">
                        <strong>{{ $errors->first('password') }}</strong>
                    </span>
                @endif
              </div>
            <br />
            <center>
              <div class='row'>
                <button type='submit' name='login' class='col s12 btn btn-large waves-effect waves-light teal disabled' id="btn-login">Login</button>
              </div>
              <div class="row">
                <span style="margin-top: 10px;"> Belum Punya Akun ? <a href="{{route('register')}}" class="teal-text"> Register</a></span>
              </div>
            </center>
          </form>
        </div>
      </div>
      <div class="row">
    <div class="section"></div>
      <a href="{{ route('index.user') }}" class="btn teal"> <i class="material-icons left">home</i>Back To Homepage</a>
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

        $('#login-box').mouseover(function(){
            $('#login-box').addClass('white');
            $('#login-box').removeClass('grey');
        });

        $('#login-box').mouseout(function(){
                $('#login-box').addClass('grey');
                $('#login-box').removeClass('white');
            
        });
    });
  </script>
</body>
</html>
